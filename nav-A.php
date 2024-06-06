<?php
session_start();
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <link rel="icon" href="images/icon.png"/>
  <title>Administrator</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <header>
    <div class="logo"><img src="images/selfo.jpg" alt="Company Logo"></div>
    <nav>
      <a class="active" href="loginpage.php">Home</a>
      <a href="listStudyMaterial.php">Study Material</a>
      <a href="listPastYear.php">Past Year</a>
      <a href="listBasicUser.php">Basic User</a>
      <a href="listPremiumUser.php">Premium User</a>
      <a href="listTutor.php">Tutor</a>
    </nav>
    <div class="dropdown">
      <div class="profile">
        <img src="images/profile.png" alt="Profile Icon"/>
        <button class="dropbtn"><?php echo htmlspecialchars($admin_name); ?></button>
      </div>
      <div class="dropdown-content">
        <a href="profilepage.php">Profile</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>