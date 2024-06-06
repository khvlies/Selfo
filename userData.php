<?php

if (!isset($_SESSION['admin']) && !isset($_SESSION['tutor']) && !isset($_SESSION['premium']) && !isset($_SESSION['basic'])) {
    header("Location: loginpage.php");
    exit();
}

include("dbconn_selfo.php");

function fetchUserData($dbconn, $session_name, $table, $id_field) {
    $uid = $_SESSION[$session_name];
    $sql = "SELECT * FROM $table WHERE $id_field = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

$user = null;
$userrole = '';
$mainPageURL = '';

if (isset($_SESSION['admin'])) {
    $user = fetchUserData($dbconn, 'admin', 'admin', 'admin_id');
    $userrole = 'Admin';
    $mainPageURL = 'adminpage.php';
} elseif (isset($_SESSION['tutor'])) {
    $user = fetchUserData($dbconn, 'tutor', 'tutor', 'tutor_id');
    $userrole = 'Tutor';
    $mainPageURL = 'tutor_page.php';
} elseif (isset($_SESSION['premium'])) {
    $user = fetchUserData($dbconn, 'premium', 'premium_user', 'premium_id');
    $userrole = 'Premium User';
    $mainPageURL = 'premiumMainpage.php';
} elseif (isset($_SESSION['basic'])) {
    $user = fetchUserData($dbconn, 'basic', 'basic_user', 'basic_id');
    $userrole = 'Basic User';
    $mainPageURL = 'basicMainpage.php';
}
?>
