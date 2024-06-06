<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Home</title>
  <link rel="stylesheet" href="css/login.css">
  <script>
    function setUserType(userType) {
      document.getElementById('userType').value = userType;
    }
    // Function to show pop-up alert if there's an error
    function showError(message) {
      alert(message);
    }
  </script>
</head>
<body>
  <div class="content-left">
    <div class="welcome-message">
      Welcome to Selfo!
      <br><br>
    </div>
    <div class="intro">
      Selfo is a self-management company where specialize in providing an organized and systematic platform to manage tasks and assignments. This company was established on March 25, 2024, by Dalili, Damia, Ilyani and Khaliesah and it is located in Raub, Pahang. The goal of this company is to introduce technology in learning matters as soon as it can make it easier for the users to track the progress of their work more efficient and effectively.
      <br><br>
    </div>
  </div>
  <div class="container">
    <div class="logo">
      <img src="images/selfo.jpg" alt="Company Logo" style="width: 140px; height: auto;">
    </div>
    <form id="login-form" action="loginSession.php" method="post">
      <input type="text" name="un" placeholder="User Name" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
    <input type="button" value="Sign Up" onclick="window.location.href='signupType.php';" aria-label="Sign Up">
  </div>

  <!-- Check for error message in PHP session and display alert if exists -->
  <?php
  session_start();
  if (isset($_SESSION['error'])) {
      echo "<script>showError('" . $_SESSION['error'] . "');</script>";
      unset($_SESSION['error']); // Clear the error after displaying
  }
  ?>
  
  <footer>
    2024 Copyright Reserved
  </footer>
</body>
</html>