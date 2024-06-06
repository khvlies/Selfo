<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Sign Up Basic User</title>
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
      flex-direction: column;
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
    }
    .logo img {
      width: 70px;
      height: auto;
    }
    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      margin-top: 250px;
      text-align: left;
    }
    input[type=text], input[type=email], input[type=tel] {
      width: 100%;
      padding: 15px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 15px;
      box-sizing: border-box;
    }
    input[type=text]:focus, input[type=email]:focus, input[type=tel]:focus {
      border-color: #097F94;
      outline: none;
    }
    hr {
      border: 1px solid #097F94;
      width: 100%;
      margin: 10px 0;
    }
    button {
      background-color: #097F94;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: 1px solid #097F94;
      border-radius: 15px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #ffffff;
      color: #097F94;
    }
    .backbtn {
      background-color: #054652;
      border: 1px solid #054652;
    }
    .backbtn:hover {
      background-color: white;
      color: #054652;
    }
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
    .premium-notice {
      color: red;
      font-size: 1em;
      margin-top: 15px;
      text-align: center;
    }
    @media screen and (max-width: 300px) {
      .backbtn, .confirmbtn {
        width: 100%;
      }
    }

  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelector('.free-notice').style.display = 'block';
    });
  </script>
</head>
<body>
  <div class="header">
    <div class="logo">
      <img src="images/selfo.jpg" alt="Company Logo">
    </div>
  </div>
  <div class="container">
    <form id="subscription-form" action="basic_process.php" method="post">
      <div style="font-size:1.5em; color:#696666; text-align:center;">Sign Up Basic User</div>
      <hr>
      <label for="pass"><b>Password</b></label>
      <input type="text" placeholder="Enter Password" name="basicpass" id="pass" value="" required>

      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="basicname" id="name" value="" required>

      <label for="phoneno"><b>Phone Number</b></label>
      <input type="tel" placeholder="Enter Phone Number" name="basicphone" id="phoneno"  value="" required>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="basicemail" id="email" value="" required>

      <div class="clearfix">
        <button type="submit" class="confirmbtn" name="add basic" value="New Basic Account">Confirm</button>
        <button type="button" class="backbtn" onclick="window.location.href='signupType.php';">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>