<?php
session_start();
#include db connection
include("dbconn_selfo.php");

if (!isset($_SESSION['name'])) {
  // Redirect to the form if the session is not set
  header("Location: signupType.php");
  exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from session variables
$name = $_SESSION['name'];
$uname = $_SESSION['uname'];
$phoneno = $_SESSION['phoneno'];
$email = $_SESSION['email'];
$plan = $_SESSION['plan'];

// Determine the table to insert data into
$table = $plan === 'Premium' ? 'premium_user' : 'basic_user';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO $table (name, username, phone, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $uname, $phoneno, $email);

// Execute the statement
if ($stmt->execute()) {
  $message = "Subscription successful! Thank you for choosing the " . htmlspecialchars($plan) . " plan.";
} else {
  $message = "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();

// Destroy session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscription Confirmed</title>
  <style>
    /* Your existing styles here */
  </style>
</head>
<body>
  <div class="header">
    <div class="logo">
      <img src="images/selfo.jpg" alt="Company Logo">
    </div>
  </div>
  <div class="container">
    <div class="confirmation">
      <?php echo $message; ?>
    </div>
    <div class="clearfix">
      <button type="button" class="backbtn" onclick="window.location.href='index.html';">Back to Home</button>
    </div>
  </div>
</body>
</html>
