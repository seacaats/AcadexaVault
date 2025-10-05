<?php 

    session_start();
    require '../../controllers/functions.php';

    $login_error = $_SESSION['login-error'] ?? '';
    unset($_SESSION['login-error']);

    $error_fields = $_SESSION['error-field'] ?? [];
    if (!is_array($error_fields)) {
        $error_fields = [$error_fields];
    }
    unset($_SESSION['error-field']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../../output.css" rel="stylesheet" />
    <link href="../../styles.css" rel="stylesheet"/>    
    <script src="auth.js"></script>
    <title>Sign in to Acadexa</title>
</head>
<body id="auth" class="flex flex-col min-h-screen bg-gradient-to-b from-blue-900 via-gray-700 to-green-900 font-sans">

    <main class="flex flex-1 justify-center items-center w-full">
        <div id="login-form" class="bg-white rounded-xl p-8 shadow-2xl max-w-md w-full">
            <form action="../../controllers/auth_handler.php" method="post" class="flex flex-col items-center">
                <img src="../../../assets/images/University_of_Pangasinan_logo.png" alt="University Logo" class="w-2/5 mb-1" />
                <h1 class="text-center text-gray-800 font-medium text-3xl mb-2">Sign in to Acadexa</h1>
                <div class="w-full">
                    <label for="email" class="block mb-1 text-gray-900 font-normal text-lg">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" 
                            class="w-full p-2.5 rounded-lg border border-gray-500 mb-5 transition-colors duration-300 focus:outline-none focus:border-blue-500 
                            <?= in_array('email', $error_fields) ? 'border-red-600' : '' ?>"/>
                    <label for="password" class="block mb-1 text-gray-900 font-normal text-lg">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" 
                            class="w-full p-2.5 rounded-lg border border-gray-500 mb-5 transition-colors duration-300 focus:outline-none focus:border-blue-500 
                            <?= in_array('password', $error_fields) ? 'border-red-600' : '' ?>"/>

                    <?= showError($login_error); ?>

                    <button type="submit" name="login" class="w-10/12 max-w-sm mx-auto block bg-green-700 hover:bg-green-800 text-white font-semibold text-base 
                                                            rounded-md py-3 cursor-pointer transition-colors mb-5">Log in</button>
                </div>
            </form>

            <div class="text-center text-base">
                <p class="mb-2.5">
                        Don't have an account? 
                    <a href="signup.php" class="text-blue-700 hover:underline">
                        <span>Sign up</span>
                    </a>
                </p>
                <a href="reset_req.php" class="text-blue-700 hover:underline">Forgot password?</a>
            </div>
        </div>
    </main>

    <?php include('../../pages/commons/footer.html') ?>
</body>
</html>