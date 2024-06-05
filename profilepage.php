<?php
session_start();
include("userData.php");

// Debugging: Print the user data to check if it's correctly fetched
/*echo '<pre>';
print_r($user);
echo '</pre>';*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #097F94;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .header {
      background-color: #fff;
      padding: 5px 0;
      text-align: center;
      position: fixed;
      top: 0;
      width: 100%;
      height: 80px;
      z-index: 1000;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .logo img {
      width: 70px;
      height: auto;
    }
    .main-content {
      padding: 20px;
      width: 700px;
      max-width: 90%;
      background-color: #fff;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 350px;
    }
    .picture {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 20px;
    }
    .picture img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .picture label {
      background-color: blue;
      color: white;
      padding: 12px;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }
    .picture input {
      display: none;
    }
    .profile-info {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .profile-info p {
      margin: 5px 0;
    }
    input[type=text], input[type=password], input[type=email], input[type=tel] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 15px;
      box-sizing: border-box;
    }
    input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=tel]:focus {
      border-color: #097F94;
      outline: none;
    }
    button {
      background-color: #097F94;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #065e6d;
    }
    .edit-button {
      font-size: medium;
      color: #4CAF50;
      background-color: #ffffff;
      border: 1px solid #4CAF50;
      cursor: pointer;
    }
    .edit-button:hover {
      background-color: #45a049;
      color: #ffffff;
    }
    .cancel-button {
      font-size: medium;
      color: rgb(197, 0, 0);
      background-color: #ffffff;
      border: 1px solid rgb(197, 0, 0);
      cursor: pointer;
    }
    .cancel-button:hover {
      background-color: rgb(197, 0, 0);
      color: #ffffff;
    }
    .updateprofile-button {
      display: flex;
      justify-content: space-between;
    }
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="logo">
      <a href="adminpage.php"><img src="images/selfo.jpg" alt="Company Logo"></a>
    </div>
  </div>

  <div class="main-content">
    <div class="picture">
      <img src="images/profile.png" id="profile-pic">
      <label for="input-file">Update Image</label>
      <input type="file" accept="image/jpeg, image/jpg, image/png" id="input-file">
    </div>
    <div class="profile-info">
      <form action="/update_profile" method="post">
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" value="<?php echo htmlspecialchars($user['admin_name'] ?? $user['tutor_name'] ?? $user['premium_name'] ?? $user['basic_name'] ?? ''); ?>" required>

        <label for="uname"><b>User ID</b></label>
        <input type="text" placeholder="Enter User ID" name="uid" value="<?php echo htmlspecialchars($_SESSION['admin'] ?? $_SESSION['tutor'] ?? $_SESSION['premium'] ?? $_SESSION['basic'] ?? ''); ?>" required>

        <label for="phoneno"><b>Phone Number</b></label>
        <input type="tel" placeholder="Enter Phone Number" name="phoneno" value="<?php echo htmlspecialchars($user['admin_phone'] ?? $user['tutor_phone'] ?? $user['premium_phone'] ?? $user['basic_phone'] ?? ''); ?>" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" value="<?php echo htmlspecialchars($user['admin_email'] ?? $user['tutor_email'] ?? $user['premium_email'] ?? $user['basic_email'] ?? ''); ?>" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" value="<?php echo htmlspecialchars($user['admin_password'] ?? $user['tutor_password'] ?? $user['premium_password'] ?? $user['basic_password'] ?? ''); ?>" required>

        <div class="clearfix updateprofile-button">
          <button type="submit" class="edit-button">Update</button>
          <span style="margin: 0 10px;"></span>
          <button type="button" class="cancel-button" onclick="window.location.reload();">Cancel</button>
        </div>
      </form>
    </div>
  </div>
<script>
  let profilePic = document.getElementById("profile-pic");
  let inputFile = document.getElementById("input-file");

  inputFile.onchange = function(){
    profilePic.src = URL.createObjectURL(inputFile.files[0]);
  }
</script> 
</body>
</html>
