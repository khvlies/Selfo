<?php
session_start();
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #097F94;
    }
    .menu {
      padding: 50px 0;
      text-align: center;
    }
    .menu a {
      text-decoration: none;
      color: #fff;
      padding: 20px 30px;
    }
    .menu a:hover {
      background-color: #ddd;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      background-color: #fff;
      position: fixed;
      top: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }
    .logo img {
      width: 80px;
      height: auto;
      padding: 10px;
      margin-left: 10px;
    }
    .menu-items {
      display: flex;
      justify-content: center;
      flex: 1;
    }
    .menu-items a {
      padding: 20px 30px;
      color: black;
      text-align: center;
      text-decoration: none;
    }
    .menu-items a:hover:not(.active) {
      background-color: #097F94;
      color: white;
    }
    .active {
      background-color: #097F94 !important;
      color: white !important;
    }
    .profile {
      display: flex;
      align-items: center;
      padding-right: 20px;
      z-index: 2002;
    }
    .profile img {
      width: 50px;
      height: auto;
      border-radius: 50%;
      margin-right: 10px;
    }
    .content {
      padding: 20px;
      margin-top: 80px;
      min-height: calc(100vh - 80px);
      position: relative;
      z-index: 999;
    }
    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-evenly;
      margin-top: 120px;
    }
    .column {
      flex: 1;
      max-width: 250px;
      margin: 5px;
      min-width: 250px;
    }
    .box-content {
      background-color: #fff;
      padding: 40px;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .box-content img {
      width: 100%;
      height: auto;
      border-radius: 15px;
      max-height: 200px;
      object-fit: cover;
    }
    @media screen and (max-width: 600px) {
      .profile img {
        width: 40px;
      }
      .menu-items a {
        padding: 10px;
      }
      .column {
        min-width: 100%;
      }
    }
    .dropbtn {
      color: black;
      background-color: white;
      font-size: 16px;
      border: none;
    }

    .dropdown {
      position: relative;
      z-index: 2000;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 2001;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #097F94;
      color: white;
    }

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {
      color: #097F94;
    }
  </style>
</head>
<body>
  <ul>
    <li class="logo"><img src="../images/selfo.jpg" alt="Company Logo"></li>
    <div class="menu-items">
      <a class="active" href="admin_page.php">Home</a>
      <a href="listStudyMaterial.php">Study Material</a>
      <a href="listPastYear.php">Past Year</a>
      <a href="listBasicUser.php">Basic User</a>
      <a href="listPremiumUser.php">Premium User</a>
      <a href="listTutor.php">Tutor</a>
    </div>
    <li class="profile">
      <img src="../images/profile.png" alt="Profile Icon"/>
      <div class="dropdown">
        <button class="dropbtn"><?php echo htmlspecialchars($admin_name); ?></button>
        <div class="dropdown-content">
          <a href="../profilepage.php">Profile</a>
          <a href="#">Settings</a>
          <a href="../loginpage.php">Logout</a>
        </div>
      </div>
    </li>
  </ul>
  
  <div class="content">
    <div class="row">
      <div class="column">
        <div id="Study Material" class="box-content">
          <img src="../images/studymaterial.png" alt="Book Icon">
          <h2>Study Material</h2>
        </div>
      </div>
      <div class="column">
        <div id="Past Year" class="box-content">
          <img src="../images/pastyear.png" alt="Question Icon">
          <h2>Past Year</h2>
        </div>
      </div>
      <div class="column">
        <div id="Tutor" class="box-content">
          <img src="../images/tutor.png" alt="Chatbox Icon">
          <h2>Tutor</h2>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
