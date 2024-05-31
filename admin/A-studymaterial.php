<?php
session_start();

$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
$current_page = basename($_SERVER['PHP_SELF']);
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
      background-color: #097F94;
      padding: 50px 0;
      text-align: center;
    }
    .menu a {
      text-decoration: none;
      color: #fff;
      padding: 0 30px;
    }
    .menu a:hover {
      background-color: #ddd;
      color: #fff;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
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
    }
    .profile img {
      width: 50px;
      height: auto;
      border-radius: 50%;
      margin-right: 10px;
    }
    .profile a {
      color: black;
      text-decoration: none;
    }
    .profile a:hover {
      color: #097F94;
    }
    @media screen and (max-width: 600px) {
      .profile img {
        width: 40px;
      }
      .menu-items a {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <ul>
    <li class="logo"><img src="../images/selfo.jpg" alt="Company Logo"></li>
    <div class="menu-items">
      <a class="active" href="admin_page.php">Home</a>
      <a href=" listStudyMaterial.php">Study Material</a>
      <a href=" listPastYear.php">Past Year</a>
      <a href=" listBasicUser.php">Basic User</a>
      <a href=" listPremiumUser.php">Premium User</a>
      <a href=" listTutor.php">Tutor</a>
    </div>
    <li class="profile">
      <img src="../images/profile.png" alt="Profile Icon"/>
      <a href="profilepage.php"><?php echo htmlspecialchars($admin_name); ?></a>
    </li>
  </ul>
</body>
</html>