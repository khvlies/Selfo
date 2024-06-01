<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="css/style1.css">
  <script>
    function setUserType(userType) {
      document.getElementById('role').value = userType;
    }
  </script>
</head>
<body>
  <div class="welcome-message">
    Welcome to Selfo!
  </div>
  <div class="container">
    <div class="logo">
      <img src="images/selfo.jpg" alt="Company Logo" style="width: 140px; height: auto;">
    </div>
    <div class="user-type-btns">
      <input type="button" value="User" onclick="setUserType('basic_user');">
      <span style="margin: 0 10px;"></span>
      <input type="button" value="Admin" onclick="setUserType('admin');">
      <span style="margin: 0 10px;"></span>
      <input type="button" value="Tutor" onclick="setUserType('tutor');">
      <span style="margin: 0 10px;"></span>
      <input type="button" value="Premium User" onclick="setUserType('premium_user');">
    </div>

    <form action="loginSession.php" method="post">
      <input type="hidden" id="role" name="role" value="basic_user">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name="Submit" value="Login">
    </form>
    <input type="button" value="Sign Up" onclick="window.location.href='/signup';">
  </div>
</body>
</html>
