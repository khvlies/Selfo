<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <ul>
    <li class="logo"><img src="images/selfo.jpg" alt="Company Logo"></li>
    <div class="menu-items">
      <a href=" /SLMS2/listStudyMaterial.php">Study Material</a>
      <a href=" /SLMS2/listPastYear.php">Past Year</a>
      <a href=" /SLMS2/listBasicUser.php">Basic User</a>
      <a href=" /SLMS2/listPremiumUser.php">Premium User</a>
      <a href=" /SLMS2/listTutor.php">Tutor</a>
    </div>
    <li class="profile">
      <img src="images/profile.png" alt="Profile Icon"/>
      <a href="#profile">Username</a>
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
        <div id="Tutor" class="box-content">
          <img src="images/tutor.png" alt="Chatbox Icon">
          <h2>Tutor</h2>
        </div>
      </div>
    </div>
  </div>
</body>
</html>