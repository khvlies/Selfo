<?php
include("dbconn_selfo.php"); // Include your database connection
session_start();

// Define USER_ROLES constant
define('USER_ROLES', [
    'admin' => [
        'table' => 'admin',
        'name_field' => 'admin_name',
        'phone_field' => 'admin_phone',
        'email_field' => 'admin_email'
    ],
    'tutor' => [
        'table' => 'tutor',
        'name_field' => 'tutor_name',
        'phone_field' => 'tutor_phone',
        'email_field' => 'tutor_email'
    ],
    'premium' => [
        'table' => 'premium_user',
        'name_field' => 'premium_name',
        'phone_field' => 'premium_phone',
        'email_field' => 'premium_email'
    ],
    'basic' => [
        'table' => 'basic_user',
        'name_field' => 'basic_name',
        'phone_field' => 'basic_phone',
        'email_field' => 'basic_email'
    ]
]);

// Ensure the user is logged in
if (!isset($_SESSION['admin']) && !isset($_SESSION['tutor']) && !isset($_SESSION['premium']) && !isset($_SESSION['basic'])) {
    header("Location: loginpage.php");
    exit();
}

// Retrieve form data
$name = $_POST['name'];
$phoneno = $_POST['phoneno'];
$email = $_POST['email'];

// Determine user role and prepare SQL accordingly
$userrole = '';
$table = '';
$name_field = '';
$phone_field = '';
$email_field = '';
$current_name = '';

if (isset($_SESSION['admin'])) {
    $userrole = 'admin';
} elseif (isset($_SESSION['tutor'])) {
    $userrole = 'tutor';
} elseif (isset($_SESSION['premium'])) {
    $userrole = 'premium';
} elseif (isset($_SESSION['basic'])) {
    $userrole = 'basic';
}

if ($userrole) {
    $role_details = USER_ROLES[$userrole];
    $table = $role_details['table'];
    $name_field = $role_details['name_field'];
    $phone_field = $role_details['phone_field'];
    $email_field = $role_details['email_field'];
    $current_name = $_SESSION[$userrole];
} else {
    // Invalid session
    header("Location: loginpage.php");
    exit();
}

// Validate input data if necessary
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Prepare and bind the SQL statement
$sql = "UPDATE $table SET $name_field = ?, $phone_field = ?, $email_field = ? WHERE $name_field = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param('ssss', $name, $phoneno, $email, $current_name);

// Execute the query
if ($stmt->execute()) {
    // Update the session with the new name
    $_SESSION[$userrole] = $name;
    
    // JavaScript for success message and redirection
    echo "<script>
        alert('Profile updated successfully');
        window.location.href = 'profilepage.php'; // Redirect to home page
    </script>";
} else {
    echo "Error updating profile: " . $stmt->error;
}

$stmt->close();
$dbconn->close();

exit();
?>
