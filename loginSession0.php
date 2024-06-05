<?php
session_start();
include("dbconn_selfo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = mysqli_real_escape_string($dbconn, $_POST['uid']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    function verifyUser($dbconn, $uid, $password, $table, $id_field, $password_field, $session_name, $redirect_page) {
        $sql = "SELECT * FROM $table WHERE $id_field = ? AND $password_field = ?";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param('ss', $uid, $password);
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

    verifyUser($dbconn, $uid, $password, 'admin', 'admin_id', 'admin_password', 'admin', 'admin/adminMainpage.php');
    verifyUser($dbconn, $uid, $password, 'tutor', 'tutor_id', 'tutor_password', 'tutor', 'tutorMainpage.php');
    verifyUser($dbconn, $uid, $password, 'premium_user', 'premium_id', 'premium_password', 'premium', 'premiumMainpage.php');
    verifyUser($dbconn, $uid, $password, 'basic_user', 'basic_id', 'basic_password', 'basic', 'basicMainpage.php');

    $_SESSION['error'] = "Invalid username or password.";
    header("Location: loginpage.php");
    exit();
}

mysqli_close($dbconn);
?>
