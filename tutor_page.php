<?php
session_start();
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
  <ul>
    <li class="logo"><img src="images/selfo.jpg" alt="Company Logo"></li>
    <div class="menu-items">
      <a href=" /SLMS2/listAdditionalNotes.php">Additional Notes</a>
      <a href=" /SLMS2/listOnlineSession.php">Online Session</a>
      <a href=" /SLMS2/listPU.php">Student Details</a>
    </div>
    <li class="profile">
      <img src="images/profile.png" alt="Profile Icon"/>
      <a href=" /SLMS2/profile.php">Username</a>
    </li>
    <li class="profile">
      <img src="images/logout.png" alt="Logout Icon"/>
      <a href=" /SLMS2/logout.php">Log Out</a>
    </li>
  </ul>
  <div class="content">
    <div class="row">
      <div class="column">
        <div id="Additinal Notes" class="box-content">
          <img src="images/additionalNotes.jpg" alt="Book Icon">
          <h2>Additional Notes</h2>
        </div>
      </div>
      <div class="column">
        <div id="Online Session" class="box-content">
          <img src="images/onlineSession.jpg" alt="People Icon">
          <h2>Online Session</h2>
        </div>
      </div>
      <div class="column">
        <div id="Premium User" class="box-content">
          <img src="images/profile.png" alt="Profile Icon">
          <h2>Student Details</h2>
        </div>
      </div>
    </div>
  </div>
</body>
</html>