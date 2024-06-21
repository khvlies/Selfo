<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Check if the user is logged in
if (!isset($_SESSION['basic'])) {
    header("Location: loginpage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <link rel="icon" href="images/icon.png"/>
  <title>Basic User</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <?php include('nav-B.php'); ?>

  <div class="content">
    <div class="row">
      <div class="column">
        <div id="Study Material" class="box-content">
          <a href="listSM.php"><img src="images/studymaterial.png" alt="Book Icon"></a>
          <h2>Study Material</h2>
        </div>
      </div>
      <div class="column">
        <div id="Past Year" class="box-content">
          <a href="listPY.php"><img src="images/pastyear.png" alt="Question Icon"></a>
          <h2>Past Year</h2>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
