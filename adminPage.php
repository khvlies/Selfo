<?php
session_start();
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
  <ul>
    <li class="logo"><img src="images/selfo.jpg" alt="Company Logo"></li>
    <div class="menu-items">
      <a href="listStudyMaterial.php">Study Material</a>
      <a href="listPastYear.php">Past Year</a>
      <a href="listBasicUser.php">Basic User</a>
      <a href="listPremiumUser.php">Premium User</a>
      <a href="listTutor.php">Tutor</a>
    </div>
    <li class="profile">
      <img src="images/logout.png" alt="Logout Icon"/>
      <a href=" /SLMS2/logout.php">Log Out</a>
    </li>
  </ul>
  <div class="content">
    <div class="row">
      <div class="column">
        <div id="Study Material" class="box-content">
          <img src="images/studymaterial.png" alt="Book Icon">
          <h2>Study Material</h2>
        </div>
      </div>
      <div class="column">
        <div id="Past Year" class="box-content">
          <img src="images/pastyear.png" alt="Question Icon">
          <h2>Past Year</h2>
        </div>
      </div>
      <div class="column">
        <div id="Users" class="box-content">
          <img src="images/profile.png" alt="Profile Icon">
          <h2>Users</h2>
        </div>
      </div>
      <div class="column">
        <div id="Tutor" class="box-content">
          <img src="images/tutor.png" alt="Chatbox Icon">
          <h2>Tutor</h2>
        </div>
      </div>
    </div>
  </div>
</body>
</html>