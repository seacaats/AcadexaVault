<?php

session_start();
require_once '../config/conn.php';
require 'functions.php';

date_default_timezone_set('Asia/Manila');

$confirmCleanup = $conn->prepare("DELETE FROM pending_registrations WHERE token_expires_at <= NOW()");
$confirmCleanup->execute();

$resetCleanup = $conn->prepare("UPDATE users
                                SET reset_token = NULL, token_expires_at = NULL
                                WHERE token_expires_at <= NOW()");
$resetCleanup->execute();


//Sign in
if (isset($_POST['login'])) {
    $inputs = [
        'email' => trim($_POST['email']) ?? '',
        'password' => $_POST['password'] ?? ''
    ];

    validateInputs($inputs, 'login', 'login.php');

    $check = $conn-> prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$inputs['email']]);
    $user = $check->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($inputs['password'], $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;

        session_regenerate_id(true);

        header("Location: ../pages/user/user_profile.php");
        exit();
    } else if (!$user) {
        $_SESSION['login-error'] = 'Email not found';
        header("Location: ../pages/auth/login.php");
        exit();
    }

    $_SESSION['login-error'] = 'Incorrect email or password';
    header("Location: ../pages/auth/login.php");
    exit();
}


//Sign Up
if (isset($_POST['signup'])) {
    $mname = $_POST['mname'];

    $inputs = [
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
        'password' => $_POST['password'],
        'role_id' => $_POST['role_id']
    ];

    validateInputs($inputs, 'signup', 'signup.php');
    validateEmail($_POST['role_id'], $_POST['email'], 'signup');
    $userEmailResult = checkEmail($conn, 'users', $inputs['email']);
    $pendingEmailResult = checkEmail($conn, 'pending_registrations', $inputs['email']);
    
    if($pendingEmailResult) {
        $_SESSION['signup-error'] = 'A confirmation email has already been sent to this address. Please check your email.';
        header("Location: ../pages/auth/signup.php");
        exit();
    } else if ($userEmailResult) {
        $_SESSION['signup-error'] = 'Email has already been registered';
        header("Location: ../pages/auth/signup.php");
        exit();
    } else if (!$userEmailResult) {
        validatePassword($_POST['password'], "../pages/auth/signup.php");
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $confirmation_token = bin2hex(random_bytes(16));
        $token_expires_at = date('Y-m-d H:i:s', time() + 60 * 60);

        $confirmUrl = "http://localhost/AcadexaVault/src/controllers/auth_handler.php?confirmation-token=$confirmation_token";
    
        $body = <<<END
        Click <a href="$confirmUrl">here</a> to continue creating your account. <br>
        This link will expire in 1 hour. <a href="http://localhost/AcadexaVault/src/pages/auth/signup.php">
        Click here to restart your signup process.</a>
        END;

        $insert = $conn->prepare("INSERT INTO pending_registrations(email, password, firstname, middlename, lastname, role_id, confirmation_token, token_expires_at)
                                        VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

        if ($insert->execute([$inputs['email'], $hashedPassword, $inputs['fname'], $mname, $inputs['lname'], $inputs['role_id'], $confirmation_token, $token_expires_at])) {
            if (sendEmail($inputs['email'], 'Confirm Account', $body)) {
                $_SESSION['email-sent'] = 'A confirmation email has been sent, <br> please kindly check your email.';
                header("Location: ../pages/auth/signup.php");
                exit();
            } else {
                $deletePending = $conn->prepare("DELETE FROM pending_registrations WHERE email = ? AND confirmation_token = ?");
                $deletePending->execute($inputs['email'], $confirmation_token);

                $_SESSION['signup-error'] = 'Failed to continue signup process. <br> 
                                            Please try again.';
                header("Location: ../pages/auth/signup.php");
                exit();
            }
        }
    }
}

if(isset($_GET['confirmation-token'])) {
    $token = $_GET['confirmation-token'];

    $check = $conn->prepare("SELECT * FROM pending_registrations WHERE confirmation_token = ?
                                AND confirmation_token IS NOT NULL AND token_expires_at > NOW()");
    $check->execute([$token]);
    $pendingUser = $check->fetch(PDO::FETCH_ASSOC);

    if ($pendingUser) {
        $_GET['confirmation-token'] = $token;
        header("Location: ../pages/auth/confirm_acc.php?confirmation-token=" . urlencode($token));
        exit();
    } else {
        $_SESSION['link-expiration'] = 'The link you were redirected to <br> has been expired. <br><br>
                                        Please <a href="signup.php">sign up again</a>.';
        header("Location: ../pages/auth/confirm_acc.php");
        exit();
    }
}

if(isset($_POST['confirm-account'])) {
    $token = $_POST['confirmation-token'] ?? '';

    $check = $conn->prepare("SELECT * FROM pending_registrations WHERE confirmation_token = ?
                                AND confirmation_token IS NOT NULL AND token_expires_at > NOW()");
    $check->execute([$token]);
    $pendingUser = $check->fetch(PDO::FETCH_ASSOC);

    if ($pendingUser) {
            $insert = $conn->prepare("INSERT INTO users(email, password, firstname, middlename, lastname, role_id)
                                            VALUES(?, ?, ?, ?, ?, ?)");

            if ($insert->execute([$pendingUser['email'], $pendingUser['password'], $pendingUser['firstname'], $pendingUser['middlename'],
                                        $pendingUser['lastname'], $pendingUser['role_id']])) {
                $clearPending = $conn->prepare("DELETE FROM pending_registrations WHERE email = ?");
                $clearPending->execute([$pendingUser['email']]);  
                
                $_SESSION['signup-success'] = 'Congratulations, your account has been <br>
                                                successfully created.';
                header("Location: ../pages/auth/confirm_acc.php");
                exit();
            } else {
                $_SESSION['signup-error'] = 'Failed to create account, please try again';
                header("Location: ../pages/auth/confirm_acc.php?confirmation-token=" . urlencode($token));
                exit();
            }
    } else {
        $_SESSION['link-expiration'] = 'The link you were redirected to <br> has been expired. <br><br>
                                        Please <a href="signup.php">sign up again</a>.';
        header("Location: ../pages/auth/confirm_acc.php");
        exit();
    }
}


//Reset Password
if (isset($_POST['reset-form'])) {
    $email = $_POST['email'];

    $emailResult = checkEmail($conn, 'users', $email);

    if ($emailResult) {
        $reset_token = bin2hex(random_bytes(16));
        $token_expires_at = date("Y-m-d H:i:s", time() + 60 * 60);

        $update = $conn->prepare("UPDATE users
                                    SET reset_token = ?,
                                        token_expires_at = ?
                                    WHERE EMAIL = ?");

        if($update->execute([$reset_token, $token_expires_at, $email])) {
            $resetUrl = "http://localhost/AcadexaVault/src/controllers/auth_handler.php?reset-token=$reset_token";
            
            $body = <<<END
            Click <a href="$resetUrl">here</a> to reset your password.
            This link will expire in 1 hour.
            END;

            if (sendEmail($email, 'Password Reset', $body)) {
                $_SESSION['email-sent'] = 'An email to continue the process has been sent, <br>
                                            please check your email.';
                header("Location: ../pages/auth/reset_req.php");
                exit();
            } else {
                $_SESSION['reset-error'] = 'Failed to continue the password reset <br> 
                                            process. Please try again';
                header("Location: ../pages/auth/reset_req.php");
                exit();
            }
        }
    } else {
        $_SESSION['email-not-found'] = 'Email not found, please enter a valid email';
        header("Location: ../pages/auth/reset_req.php");
        exit();
    }
}


if (isset($_GET['reset-token'])) {
    $token = $_GET['reset-token'];

    $check = $conn->prepare("SELECT * FROM users WHERE reset_token = ?
                                AND reset_token IS NOT NULL AND token_expires_at > NOW()");
    $check->execute([$token]);
    $user = $check->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_GET['reset-token'] = $token;
        header("Location: ../pages/auth/reset_pw.php?reset-token=" . urlencode($token));
        exit();
    } else {
        $_SESSION['link-expiration'] = 'The link you were redirected to <br> has been expired. <br><br>
                                        <a href="reset_req.php">Please request a new one.</a>';
        header("Location: ../pages/auth/reset_pw.php");
        exit();
    }
}


if (isset($_POST['reset-password'])) {
    $token = $_POST['reset-token'] ?? '';
    $password = $_POST['password'];
    $confirmed_password = $_POST['password-confirmation'];


    if ($password !== $confirmed_password) {
        $_SESSION['reset-error'] = 'Passwords do not match';
        header("Location: ../pages/auth/reset_pw.php?reset-token=" . urlencode($token));
        exit();
    }
    validatePassword($password, "../pages/auth/reset_pw.php?reset-token=" . urlencode($token));

    $check = $conn->prepare("SELECT * FROM users WHERE reset_token = ? 
                            AND reset_token IS NOT NULL AND token_expires_at > NOW()");
    $check->execute([$token]);
    $user = $check->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $newPassword = password_hash($password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password = ?,
                                    reset_token = NULL, token_expires_at = NULL
                                    WHERE email = ?");

        if ($update->execute([$newPassword, $user['email']])) {
            $_SESSION['reset-success'] = 'Password reset successfully.';
            header("Location: ../pages/auth/reset_pw.php");
            exit();
        } else {
            $_SESSION['reset-error'] = 'Failed to reset password';
            header("Location: ../pages/auth/reset_pw.php?reset-token=" . urlencode($token));
            exit();
        }
    } else {
        $_SESSION['link-expiration'] = 'The link you were redirected to <br> has been expired. <br><br>
                                        Please <a href="reset_req.php">request</a> a new one.';
        header("Location: ../pages/auth/reset_pw.php");
        exit();
    }
}

?>