<?php

    session_start();
    require '../../controllers/functions.php';

    $token = $_GET['reset-token'] ?? '';
    $reset_success = $_SESSION['reset-success'] ?? '';
    $reset_error = $_SESSION['reset-error'] ?? '';
    $expired_link = $_SESSION['link-expiration'] ?? '';

    $error_fields = $_SESSION['error-field'] ?? [];
    if (!is_array($error_fields)) {
        $error_fields = [$error_fields];
    }

    unset($_SESSION['reset-success'], $_SESSION['reset-error'], $_SESSION['link-expiration'], $_SESSION['error-field']);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="auth_main.css" rel="stylesheet" type="text/css"/>
    <script src="auth.js"></script>
    <title>Change your password</title>
</head>
<body id="reset-pw">
    <div class="container">
        <div class="container-box" id="reset-password">
            <form action="../../controllers/auth_handler.php" method="post"> 
                <input type="hidden" name="reset-token" value="<?= htmlspecialchars($token) ?>">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png"/> 
                <h1>Change your password</h1>
                <?php if ($expired_link) : ?>
                    <?= showMessage($expired_link) ?>

                <?php elseif ($reset_success) : ?> 
                    <?= showMessage($reset_success) ?>

                    <div class="form-footer">
                        <p>Return to <a href="login.php">sign in</a></p>
                    </div>
                    
                <?php else : ?>
                    <p>Passwords should be at least 8 characters long <br> and contain the following:
                    1 lower/upper case letter, <br> 1 number, and 1 special character</p>
                
                    <label for="password">New password</label>
                    <input type="password" name="password" class="<?= in_array('password', $error_fields) ? 'input-error' : '' ?>" placeholder="Enter your new password" required>
                    
                    <label for="password-confirmation">Confirm password</label>
                    <input type="password" name="password-confirmation" placeholder="Re-enter your new password" required>
                    
                    <?= showError($reset_error) ?>
                    <button type="submit" class="btn-submit" name="reset-password">Submit</button>
                <?php endif ?>
            </form> 
        </div>
    </div>
</body>
</html>