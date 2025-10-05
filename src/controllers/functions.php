<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 

//functions
function checkEmail($conn, $table,  $email) {
    $checkStmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
    $checkStmt->execute([$email]);
    $checkResult = $checkStmt->fetch(PDO::FETCH_ASSOC);

    return $checkResult;
}

function validateInputs($inputs, $auth_error, $redirectTo) {
    $errorFields = [];

    foreach ($inputs as $fieldname => $value) { 
        if (empty(trim($value))) {
            $errorFields[] = $fieldname;
        }
    }
    if (!empty($errorFields)) {
        $_SESSION["$auth_error-error"] = 'Please enter all required fields';
        $_SESSION['error-field'] = $errorFields;
        header("Location: ../pages/auth/" . $redirectTo);
        exit();
    }
}

function validateEmail($role_id, $email, $auth) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email-error'] = 'Please enter a valid email';
        $_SESSION['error-field'] = 'email';
        header("Location: ../pages/auth/$auth.php");
        exit();
    }

    if (($role_id == 2 || $role_id == 3) && !preg_match("/.up@phinmaed.com/", $email)) {
        $_SESSION['signup-error'] = 'School emails are required for Students/Faculty';
        $_SESSION['error-field'] = 'email';
        header("Location: ../pages/auth/$auth.php");
        exit();
    }

    if (($role_id == 4) && preg_match("/.up@phinmaed.com/", $email)) {
        $_SESSION['signup-error'] = 'Only Students/Faculty can sign up with their school emails';
        $_SESSION['error-failed'] = 'email';
        header("Location: ../pages/auth/$auth.php");
        exit();
    }

    return true;
}


function validatePassword($password, $redirectTo) {
    if (trim($password) === '') {
        $_SESSION['password-errors'] = 'Password cannot be empty';
        $_SESSION['error-field'] = 'password';
        header("Location: " . $redirectTo);
        exit();
    }

    $passwordErrors = [];

    if (strlen($password) < 8) {
        $passwordErrors[] = 'length';
    }
    if (!preg_match("/[a-z]/", $password)) {
        $passwordErrors[] = 'lowercase';
    }
    if (!preg_match("/[A-Z]/", $password)) {
        $passwordErrors[] = 'uppercase';
    }
    if (!preg_match("/[0-9]/", $password)) {
        $passwordErrors[] = 'number';
    }
    if (!preg_match("/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>?]/", $password)) {
        $passwordErrors[] = 'specialchar';
    }
    if (!empty($passwordErrors)) {
        $_SESSION['password-errors'] = 'Please enter a valid password';
        $_SESSION['error-field'] = 'password';
        header("Location: " . $redirectTo);
        exit();
    }
}

function sendEmail($toEmail, $subject, $body) {
    require_once '../../vendor/autoload.php';
    require_once '../config/env.php';
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $_ENV['SMTP-HOST'] ??'smtp.gmail.com';
        $mail->Port = $_ENV['SMTP-PORT'] ?? 587;
        $mail->Username = $_ENV['SMTP_USERNAME'] ?? '';
        $mail->Password = $_ENV['SMTP_PASSWORD'] ?? '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->setFrom('acadexa.up@gmail.com', 'no-reply');
        $mail->addReplyTo('acadexa.up@gmail.com', 'no-reply');
        $mail->addAddress($toEmail);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo} for email to {$toEmail}");
        return false; 
    }
}


function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function showSuccess($success) {
    return !empty($success) ? "<p class='success-message'>$success</p>" : '';
}

function showMessage($message) {
    return !empty($message) ? "<p>$message</p>" : '';
}

?>