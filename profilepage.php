
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
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
    .sidebar {
      background-color: #097F94;
      width: 250px;
      height: 100%;
      position: fixed;
      top: 80px;
      left: 0;
      padding-top: 20px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 16px;
      text-decoration: none;
      font-size: 18px;
    }
    .sidebar a:hover {
      background-color: #065e6d;
    }
    .main-content {
      margin-left: 350px;
      padding: 20px;
      width: 100%;
      height: 700px;
      max-width: 800px;
      background-color: #fff;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 100px;
    }
    .profile-info {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .profile-info img {
      width: 150px;
      height: auto;
      border-radius: 50%;
      margin-bottom: 20px;
    }
    .profile-info h2 {
      margin: 10px 0;
    }
    .profile-info p {
      margin: 5px 0;
    }
    input[type=text], input[type=password], input[type=email], input[type=tel] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      display: inline-block;
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
    }
    .cancel-button:hover {
      background-color: rgb(197, 0, 0);
      color: #ffffff;
    }
    .updateprofile-button {
      margin-bottom: 10px;
      display: flex;
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
      <img src="images/selfo.jpg" alt="Company Logo">
    </div>
  </div>

  <div class="sidebar">
    <a href="#profile">Profile</a>
    <a href="#settings">Settings</a>
    <a href="#logout">Logout</a>
  </div>

  <div class="main-content">
    <div class="profile-info">
      <img src="images/profile.png" alt="Profile Picture">
      <h2>John Doe</h2>
      <form action="/update_profile" method="post">
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required value="">
        
        <label for="uname"><b>User ID</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required value="">
        
        <label for="phoneno"><b>Phone Number</b></label>
        <input type="tel" placeholder="Enter Phone Number" name="phoneno" required value="">
        
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required value="">
        
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        
        <div class="clearfix">
          <div class="updateprofile-button">
            <button type="submit" class="edit-button">Update</button>
            <span style="margin: 0 10px;"></span>
            <button type="submit" class="cancel-button">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
