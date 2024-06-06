<?php
session_start();
include("dbconn_selfo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($dbconn, $_POST['un']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    function verifyUser($dbconn, $name, $password, $table, $name_field, $password_field, $session_name, $redirect_page) {
        $sql = "SELECT * FROM $table WHERE $name_field = ? AND $password_field = ?";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param('ss', $name, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION[$session_name] = $user[$name_field];
            $_SESSION[$session_name.'_name'] = $user[$session_name.'_name'];
            header("Location: $redirect_page");
            exit();
        }
    }

    verifyUser($dbconn, $name, $password, 'admin', 'admin_name', 'admin_password', 'admin', 'adminPage.php');
    verifyUser($dbconn, $name, $password, 'tutor', 'tutor_name', 'tutor_password', 'tutor', 'tutor_page.php');
    verifyUser($dbconn, $name, $password, 'premium_user', 'premium_name', 'premium_password', 'premium', 'premiumMainpage.php');
    verifyUser($dbconn, $name, $password, 'basic_user', 'basic_name', 'basic_password', 'basic', 'basicMainpage.php');

    $_SESSION['error'] = "Invalid username or password.";
    header("Location: loginpage.php");
    exit();
}

mysqli_close($dbconn);
?>