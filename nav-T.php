<?php
session_start();
$tutor_name = isset($_SESSION['tutor_name']) ? $_SESSION['tutor_name'] : 'Tutor';

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Check if the user is logged in
if (!isset($_SESSION['tutor'])) {
    header("Location: loginpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Tutor</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <header>
    <div class="logo"><img src="images/selfo.jpg" alt="Company Logo"></div>
    <nav>
    <div class="menu-items">
      <a class="active" href="tutor_page.php">Home</a>
      <a href="listAdditionalNotes.php">Additional Notes</a>
      <a href="listOnlineSession.php">Online Session</a>
      <a href="listPU.php">Premium User</a>
    </div>
    </nav>
    <div class="dropdown">
      <div class="profile">
        <img src="images/profile.png" alt="Profile Icon"/>
        <button class="dropbtn"><?php echo htmlspecialchars($tutor_name); ?></button>
      </div>
      <div class="dropdown-content">
        <a href="profilepage.php">Profile</a>
        <a href="logout.php">Log Out</a>
      </div>
    </div>
  </header>
  </body>
  </html>