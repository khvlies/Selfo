<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Basic User</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <ul>
    <li class="logo"><img src="images/selfo.jpg" alt="Company Logo"></li>
    <div class="menu-items">
      <a href=" /SLMS2/listSM.php">Study Material</a>
      <a href=" /SLMS2/listPY.php">Past Year</a>
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
    </div>
  </div>
</body>
</html>