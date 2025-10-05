<?php 

session_start();

if(!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
}

$user = $_SESSION['user'];
$email = $user['email'];
$firstname = $user['firstname'];
$middlename = $user['middlename'];
$lastname = $user['lastname'];
$role = $user['role_id'];

echo "Welcome, " . $firstname . " " . $lastname;

?>