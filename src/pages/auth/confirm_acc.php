<?php
    session_start();
    require '../../controllers/functions.php';

    $token = $_GET['confirmation-token'] ?? '';
    $signup_success = $_SESSION['signup-success'] ?? '';
    $signup_error = $_SESSION['signup-error'] ?? '';
    $expired_link = $_SESSION['link-expiration'] ?? '';

    if (empty($token) && empty($signup_success) && empty($signup_error) && empty($expired_link)) {
        header("Location: signup.php");
        exit();
    }

    unset($_SESSION['signup-success'], $_SESSION['signup-error'], $_SESSION['link-expiration']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../output.css" rel="stylesheet" />
    <link href="../../styles.css" rel="stylesheet"/>
    <title>Confirm your Account</title>
</head>
<body id="auth" class="flex flex-col min-h-screen bg-gradient-to-b from-blue-900 via-gray-700 to-green-900">
    <main class="flex flex-1 justify-center items-center w-full pt-4 pb-4">
        <div id="pw-reset-form" class="bg-white rounded-xl p-8 shadow-2xl max-w-sm w-full">
            <form action="../../controllers/auth_handler.php" method="post" class="flex flex-col items-center">
                <input type="hidden" name="confirmation-token" value="<?= htmlspecialchars($token) ?>">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png" alt="Repository Logo" class="w-2/5 mb-1">
                <h1 class="text-center font-medium text-2xl mb-2">Account Confirmation</h1>
                <div class="w-full">
                    <?php if ($signup_success) : ?>
                        <?= showMessage($signup_success) ?>

                        <div class="text-center text-base">
                            <p class="mb-2.5">Return to
                                <a href="login.php" class="text-blue-700 hover:underline"><span>sign in</span></a>
                            </p>
                        </div>

                    <?php elseif ($expired_link || !$token) : ?>
                        <?= showMessage($expired_link) ?>

                    <?php else : ?>
                        <p class="text-center text-gray-800 font-normal text-md mb-4">Congratulations. You've reached the last step.
                            Please click the button to confirm the creation of your account.</p>

                        <?= showError($signup_error); ?>

                        <button type="submit" name="confirm-account" class="block w-3/4 max-w-sm mx-auto py-3 rounded-md bg-green-700 
                            hover:bg-green-800 text-white font-semibold text-base cursor-pointer transition-colors mb-5">Confirm Account</button>

                    <?php endif; ?>
                </div>
            </form>
        </div>
    </main>
</body>
</html>