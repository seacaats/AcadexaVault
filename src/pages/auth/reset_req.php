<?php

    session_start();
    require '../../controllers/functions.php';

    $submitted = $_SESSION['email-sent'] ?? '';
    unset($_SESSION['email-sent']);

    $reset_error = $_SESSION['email-not-found'] ?? '';
    unset($_SESSION['email-not-found']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="auth_main.css" rel="stylesheet" type="text/css"/>
    <title>Forgot your password?</title>
</head>
<body>
    <div class="container">
        <div class="container-box" id="reset-form">
            <form action="../../controllers/auth_handler.php" method="post">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png"/>
                <h1>Reset your password</h1>
                <?php if (!$submitted): ?>
                    <p>Enter your registered email address <br> to receive a password reset link.</p>
                    <div class="form-txtbox" id="form-txtbox">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter your email address" required>
                        <?= showError($reset_error) ?>
                        <button type="submit" class="btn-submit" name="reset-form">Send password reset email</button>
                    </div>

                <?php else: ?>
                    <?= showMessage($submitted); ?>
                <?php endif; ?>
            </form>

                <div class="form-footer">
                    <p>Return to <a href="login.php">sign in</a></p>
                </div>
        </div>
    </div>

    <script src="auth.js"></script>
</body>
</html>

