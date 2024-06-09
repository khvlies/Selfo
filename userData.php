<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['tutor']) && !isset($_SESSION['premium']) && !isset($_SESSION['basic'])) {
    header("Location: loginpage.php");
    exit();
}

include("dbconn_selfo.php");

function fetchUserData($dbconn, $session_name, $table, $name_field) {
    $name = $_SESSION[$session_name];
    $sql = "SELECT * FROM $table WHERE $name_field = ?";
    $stmt = $dbconn->prepare($sql);
    if (!$stmt) {
        die("Database error: " . $dbconn->error);
    }
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

$user = null;
$userrole = '';
$mainPageURL = '';

const USER_ROLES = [
    'admin' => ['table' => 'admin', 'name_field' => 'admin_name', 'url' => 'adminpage.php'],
    'tutor' => ['table' => 'tutor', 'name_field' => 'tutor_name', 'url' => 'tutor_page.php'],
    'premium' => ['table' => 'premium_user', 'name_field' => 'premium_name', 'url' => 'premiumMainpage.php'],
    'basic' => ['table' => 'basic_user', 'name_field' => 'basic_name', 'url' => 'basicMainpage.php']
];

foreach (USER_ROLES as $role => $details) {
    if (isset($_SESSION[$role])) {
        $user = fetchUserData($dbconn, $role, $details['table'], $details['name_field']);
        $userrole = ucfirst($role);
        $mainPageURL = $details['url'];
        break;
    }
}
?>
