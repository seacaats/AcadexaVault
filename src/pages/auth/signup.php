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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../../output.css" rel="stylesheet" />
    <script src="auth.js"></script>
    <title>Sign up to Acadexa</title>
</head>
<body id="auth" class="flex flex-col min-h-screen bg-white">
    <div class="flex flex-1 flex-col lg:flex-row w-full">
        <div class="visuals flex flex-col flex-1 justify-center items-center bg-gradient-to-b from-blue-900 via-gray-700 to-green-900 lg:order-2">
            <img src="../../../assets/images/University_of_Pangasinan_logo.png" alt="University Logo" class="w-1/2" />
        </div>
        <div class="form flex flex-col flex-1 justify-center items-center p-5 bg-white lg:order-1">
            <div class="form-container w-full max-w-lg p-4">
                <form action="../../controllers/auth_handler.php" method="post" class="flex flex-col">
                    <h2 class="text-left text-gray-800 font-medium text-3xl mt-2 mb-6">Sign up to Acadexa</h2>
                    <div class="space-y-5">
                        <div class="name-field space-y-1">
                            <label for="fname" class="block text-gray-800 font-normal text-base">First Name</label>
                            <input id="fname" name="fname" type="text" placeholder="First Name" class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-400 
                                transition-all duration-300 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200
                                <?= in_array('fname', $error_fields) ? 'border-red-500 ring-red-200' : '' ?>" >
                        </div>
                        <div class="name-field space-y-1">
                            <label for="mname" class="block text-gray-800 font-normal text-base">Middle Name</label>
                            <input id="mname" name="mname" type="text" placeholder="Middle Name (Optional)" class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-400 
                                transition-all duration-300 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200
                                <?= in_array('mname', $error_fields) ? ' border-red-500 ring-red-200' : '' ?>">
                        </div>
                        <div class="name-field space-y-1">
                            <label for="lname" class="block text-gray-800 font-normal text-base">Last Name</label>
                            <input id="lname" name="lname" type="text" placeholder="Last Name" class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-400
                                transition-all duration-300 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200
                                <?= in_array('lname', $error_fields) ? ' border-red-500 ring-red-200' : '' ?>">
                        </div>
                        <div class="dropdown space-y-1">
                            <label for="role_id" class="block text-gray-800 font-normal text-base">Role</label>
                            <select id="role_id" name="role_id" class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-400 transition-all duration-300
                                focus:outline-nonefocus:border-blue-400 focus:ring-2 focus:ring-blue-200 appearance-none
                                <?= in_array('role_id', $error_fields) ? ' border-red-500 ring-red-200' : '' ?>">
                                <option value="" disabled selected>Role</option>
                                <option value="2">Student</option>
                                <option value="3">Faculty</option>
                                <option value="4">External User</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label for="email" class="block text-gray-800 font-normal text-base">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-400
                                transition-all duration-300 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200
                                <?= in_array('email', $error_fields) ? ' border-red-500 ring-red-200' : '' ?>">
                            <small class="text-gray-500 block mt-1 mb-4 text-sm">Members of the university (Students/Faculty) are required to use their 
                                given school accounts/emails.</small>
                        </div>
                        <div class="space-y-1">
                            <label for="password" class="block text-gray-800 font-normal text-base">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-400
                                transition-all duration-300 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200
                                <?= in_array('password', $error_fields) ? ' border-red-500 ring-red-200' : '' ?>">
                            <small class="text-gray-500 block mt-1 mb-4 text-sm">Passwords should be at least 8 characters long and contain the following: 
                                1 lower/upper case letter, 1 number, and 1 special character.</small>
                        </div>
                    </div>

                    <?= showError($signup_error); ?>
                    <?= showSuccess($email_sent); ?>

                    <button type="submit" class="w-full py-3.5 rounded-md bg-blue-800 hover:bg-blue-900 text-white font-semibold 
                        text-base cursor-pointer transition-colors duration-300 mt-4 mb-5" name="signup">Sign Up</button>
                </form>

                <div class="form-footer text-center text-gray-500 text-base">
                    <p class="mb-2">Already have an account? 
                        <a href="login.php" class="text-green-600 hover:underline font-medium">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include('../../pages/commons/footer.html') ?>
</body>
</html>