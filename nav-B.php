<?php
session_start();
$basic_name = isset($_SESSION['basic_name']) ? $_SESSION['basic_name'] : 'Basic User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <link rel="icon" href="images/icon.png"/>
  <title>Basic User</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <header>
    <div class="logo"><img src="images/selfo.jpg" alt="Company Logo"></div>
    <nav>
      <a class="active" href="basicMainpage.php">Home</a>
      <a href="listSM.php">Study Material</a>
      <a href="listPY.php">Past Year</a>
    </nav>
    <div class="dropdown">
      <div class="profile">
        <img src="images/profile.png" alt="Profile Icon"/>
        <button class="dropbtn"><?php echo htmlspecialchars($basic_name); ?></button>
      </div>
      <div class="dropdown-content">
        <a href="profilepage.php">Profile</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>