<?php

    session_start();
    require '../../controllers/functions.php';

    $token = $_GET['confirmation-token'] ?? '';
    $signup_success = $_SESSION['signup-success'] ?? '';
    $signup_error = $_SESSION['signup-error'] ?? '';
    $expired_link = $_SESSION['link-expiration'] ?? '';

    unset($_SESSION['signup-success'], $_SESSION['signup-error'], $_SESSION['link-expiration']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="auth_main.css" rel="stylesheet" type="text/css"/>
    <title>Confirm your Account</title>
</head>
<body>
    <div class="container">
        <div class="container-box" id="confirm-account">
            <form action="../../controllers/auth_handler.php" method="post">
                <input type="hidden" name="confirmation-token" value="<?= htmlspecialchars($token) ?>">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png"/>
                <h1>Account Confirmation</h1>
                <?php if ($expired_link) : ?>
                    <?= showMessage($expired_link); ?>

                <?php elseif ($signup_success) : ?>
                    <?= showMessage($signup_success); ?>

                    <div class="form-footer">
                        <p>Return to <a href="login.php">sign in</a></p>
                    </div>
                    
                <?php else : ?>
                    <p>Congratulations! You've reached the last step. <br>
                    Please click the button to confirm the creation <br>
                    of your account.
                    </p>
                    <?= showError($signup_error); ?>
                    <button type="submit" class="btn-submit" name="confirm-account">Confirm Account</button>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>
</html> 