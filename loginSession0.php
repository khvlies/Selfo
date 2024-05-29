<?php
session_start();
include("dbconn_selfo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    // Function to verify credentials and start session
    function verifyUser($dbconn, $username, $password, $table, $id_field, $password_field, $session_name, $redirect_page) {
        $sql = "SELECT * FROM $table WHERE $id_field = ? AND $password_field = ?";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION[$session_name] = $user[$id_field];
            $_SESSION[$session_name.'_name'] = $user[$session_name.'_name'];
            header("Location: $redirect_page");
            exit();
        }
    }

    // Check if user is an administrator
    verifyUser($dbconn, $username, $password, 'admins', 'admin_id', 'admin_password', 'admin', 'adminMainpage.php');

    // Check if user is a tutor
    verifyUser($dbconn, $username, $password, 'tutor', 'tutor_id', 'tutor_password', 'tutor', 'tutorMainpage.php');

    // Check if user is a premium user
    verifyUser($dbconn, $username, $password, 'premium_user', 'premium_id', 'premium_password', 'premium', 'premiumMainpage.php');

    // Check if user is a basic user
    verifyUser($dbconn, $username, $password, 'basic_user', 'basic_id', 'basic_password', 'basic', 'basicMainpage.php');

    // If no valid user found, redirect back to login page
    $_SESSION['error'] = "Invalid username or password.";
    header("Location: loginpage.php");
    exit();
}

mysqli_close($dbconn); // Close connection
?>
