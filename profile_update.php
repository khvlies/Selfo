<?php
session_start();
include("dbconn_selfo.php");

function updateUserProfile($dbconn, $name, $phoneno, $email, $current_psw, $new_psw = null) {
    // Verify the current password
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (password_verify($current_psw, $user['password'])) {
        // Update user data
        if ($new_psw) {
            $hashed_password = password_hash($new_psw, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = ?, phoneno = ?, email = ?, password = ? WHERE email = ?";
            $stmt = $dbconn->prepare($sql);
            $stmt->bind_param('sssss', $name, $phoneno, $email, $hashed_password, $email);
        } else {
            $sql = "UPDATE users SET name = ?, phoneno = ?, email = ? WHERE email = ?";
            $stmt = $dbconn->prepare($sql);
            $stmt->bind_param('ssss', $name, $phoneno, $email, $email);
        }
        $stmt->execute();
        $stmt->close();
        return true;
    } else {
        return false; // Invalid current password
    }
}

$name = $_POST['name'];
$phoneno = $_POST['phoneno'];
$email = $_POST['email'];
$current_psw = $_POST['current_psw'];
$new_psw = $_POST['new_psw'] ?? null;
$confirm_new_psw = $_POST['confirm_new_psw'] ?? null;

if ($new_psw && $new_psw !== $confirm_new_psw) {
    // Passwords do not match
    header("Location: profilepage.php?error=password_mismatch");
    exit();
}

if (updateUserProfile($dbconn, $name, $phoneno, $email, $current_psw, $new_psw)) {
    header("Location: profilepage.php?success=profile_updated");
} else {
    header("Location: profilepage.php?error=invalid_password");
}
?>
