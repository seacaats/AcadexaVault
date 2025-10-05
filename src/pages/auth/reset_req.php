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
    <link href="../../output.css" rel="stylesheet" />
    <link href="../../styles.css" rel="stylesheet"/>
    <title>Forgot your Password?</title>
</head>
<body id="auth" class="flex flex-col min-h-screen bg-gradient-to-b from-blue-900 via-gray-700 to-green-900">
    <main class="flex flex-1 justify-center items-center w-full pt-4 pb-4">
        <div id="pw-reset-form" class="bg-white rounded-xl p-8 shadow-2xl max-w-sm w-full">
            <form action="../../controllers/auth_handler.php" method="post" class="flex flex-col items-center">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png" alt="Repository Logo" class="w-2/5 mb-1">
                <h1 class="text-center font-medium text-2xl mb-2">Reset your Password</h1>
                <?php if(!$submitted): ?>
                    <p class="text-center text-gray-800 font-normal text-lg mb-4">Enter your registered email address <br> 
                                                                                    to receive a password reset link.</p>
                    <div class="w-full">
                        <label for="email" class="block text-gray-800 font-normal text-md mb-1">Email</label>
                        <input type="email" name="email" placeholder="Enter your email address" 
                                class="w-full px-3 py-2 border border-gray-500 rounded-lg transition-colors duration-300 
                                focus:outline-none focus:border-blue-500 mb-5"></input>
                        
                        <?= showError($reset_error); ?>

                        <button type="submit" name="reset-form" class="block w-3/4 max-w-sm mx-auto py-3 rounded-md bg-green-700 
                            hover:bg-green-800 text-white font-semibold text-base cursor-pointer transition-colors mb-5">
                            Send password reset email</button>
                    </div>
                <?php else: ?>
                    <?= showMessage($submitted); ?>
                <?php endif; ?>
            </form>

            <div class="text-center text-base">
                    <p class="mb-2.5">Return to
                        <a href="login.php" class="text-blue-700 hover:underline"><span>sign in</span></a>
                    </p>
            </div>
        </div>
    </main>

    <?php include('../../pages/commons/footer.html') ?>

    <script src="auth.js"></script>
</body>
</html>