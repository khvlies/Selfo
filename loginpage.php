<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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
    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
      margin-left: 30%;
    }
    input[type="text"], input[type="password"], input[type="submit"], input[type="button"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 15px;
      box-sizing: border-box;
    }
    input[type="submit"], input[type="button"] {
      background-color: #097F94;
      color: white;
      border: 1px solid #ccc;
      cursor: pointer;
    }
    input[type="submit"]:hover, input[type="button"]:hover {
      background-color: white;
      color:#097F94
    }
    .signup-link a {
      color: #007bff;
      text-decoration: none;
    }
    .logo {
		text-align: center;
		margin: 1px 0 1px 0;
    }
	.user-type-btns {
      margin-bottom: 10px;
      display: flex;
    }
    .user-type-btns input[type="button"] {
      flex: 1;
    }
    .welcome-message{
      color: white;
      text-align: left;
      font-size: 3em;
    }
  </style>
  <script>
    function setUserType(userType) {
      document.getElementById('userType').value = userType;
    }
  </script>
</head>
<body>
  <div class="welcome-message">
    Welcome to Selfo!
  </div>
	<div class="container">
    <div class="logo">
		<img src="selfo.jpg" alt="Company Logo" style="width: 140px; height: auto;">
    </div>
    
		<div class="user-type-btns">
		<input type="button" name="userTypeButton" value="User" onclick="setUserType('user');" aria-label="User Login">
      <span style="margin: 0 10px;"></span>
      <input type="button" name="userTypeButton" value="Tutor" onclick="setUserType('tutor');" aria-label="Tutor Login">
      <span style="margin: 0 10px;"></span>
      <input type="button" name="userTypeButton" value="Admin" onclick="setUserType('admin');" aria-label="Admin Login">
    </div>

    <form name="form" action="loginSession0.php" method="post">
      <input type="hidden" id="userType" name="userType" value="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
		<input type="button" value="Sign Up" onclick="window.location.href='signUp.php';" aria-label="Sign Up">
  </div>
</body>
</html>
