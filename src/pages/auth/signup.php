<?php

    session_start();
    require '../../controllers/functions.php';

    // if(isset($_SESSION['user'])) {
    //     header("Location: ../user/user_profile.php");
    // }

    $signup_error = $_SESSION['signup-error'] ?? '';
    unset($_SESSION['signup-error']);

    $email_sent = $_SESSION['email-sent'] ?? '';
    unset($_SESSION['email-sent']);

    $error_fields = $_SESSION['error-field'] ?? [];
    if (!is_array($error_fields)) {
        $error_fields = [$error_fields];
    }
    unset($_SESSION['error-field']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="auth_signup.css" rel="stylesheet" type="text/css">
    <script src="auth.js"></script>
    <title>Sign up to Acadexa</title>
</head>
<body id="signup">
    <div class="container">
        <section class="form">
            <div class="form-container">
                <form action="../../controllers/auth_handler.php" method="post">
                    <h2>Sign up to Acadexa</h2>
                    <div class="form-txtbox">
                        <label for="fname">First Name</label>
                        <input id="fname" name="fname" class="name-field <?= in_array('fname', $error_fields) ? 'input-error' : '' ?>" placeholder="First Name"> 
                        <label for="mname">Middle Name</label>
                        <input id="mname" name="mname" class="name-field <?= in_array('mname', $error_fields) ? 'input-error' : '' ?>" placeholder="Middle Name (Optional)">
                        <label for="lname">Last Name</label>
                        <input id="lname" name="lname" class="name-field <?= in_array('lname', $error_fields) ? 'input-error' : '' ?>" placeholder="Last Name">
                        <label for="role">Role</label>
                        <select id="role_id" name="role_id" class="dropdown <?= in_array('role_id', $error_fields) ? 'input-error' : '' ?>">
                            <option value="" disabled selected>Role</option>
                            <option value="2">Student</option>
                            <option value="3">Faculty</option>
                            <option value="4">External User</option>
                        </select>
                        <label for="email">Email</label>
                        <input type="email" name="email" class="special-field <?= in_array('email', $error_fields) ? 'input-error' : '' ?>" placeholder="Email">
                        <small>Members of the university (Students/Faculty) are required to use their
                            given school accounts/emails.</small>
                        <label for="password">Password</label>
                        <input type="password" name ="password" class="special-field <?= in_array('password', $error_fields) ? 'input-error' : '' ?>" placeholder="Password"> 
                        <small>Passwords should be at least 8 characters long and contain the following:
                            1 lower/upper case letter, 1 number, and 1 special character.</small>
                        <?= showError($signup_error);?>
                        <?= showSuccess($email_sent); ?>
                        <button type="submit" class="btn-submit" name="signup">Sign Up</button>
                    </div>

                    <footer class="form-footer">
                        <p>Already have an account? <a href="login.php"><span>Sign in</p></a></p>
                    </footer>
                </form>        
            </div>
        </section>

        <section class="visuals">
            <div class="visuals-container">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png"/>
            </div>
        </section>
    </div>
</body>
</html>