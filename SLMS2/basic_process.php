<?php
include("dbconn_selfo.php");

$b_id = mysqli_real_escape_string($dbconn, $_REQUEST['basicid']);
$b_pass = mysqli_real_escape_string($dbconn, $_REQUEST['basicpass']);
$b_name = mysqli_real_escape_string($dbconn, $_REQUEST['basicname']);
$b_phone = mysqli_real_escape_string($dbconn, $_REQUEST['basicphone']);
$b_email = mysqli_real_escape_string($dbconn, $_REQUEST['basicemail']);

$sqlInsertBasic = "INSERT INTO basic_user (basic_id, basic_password, basic_name, basic_phone, basic_email) VALUES (?, ?, ?, ?, ?)";
$stmtBasic = $dbconn->prepare($sqlInsertBasic);
$stmtBasic->bind_param("sssss", $b_id, $b_pass, $b_name, $b_phone, $b_email);

if ($stmtBasic->execute()) {
    $sqlInsertLogin = "INSERT INTO login (PASSWORD,ROLE) VALUES ( ?, ?)";
    $stmtLogin = $dbconn->prepare($sqlInsertLogin);
    $role = 'basic';
    $stmtLogin->bind_param("ss", $b_pass, $role);
    
    if ($stmtLogin->execute()) {
        echo'<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" href="images/icon.png"/>
          <title>Account Created</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              background-color: #097F94;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
              color: #fff;
              margin: 0;
            }
            .message-box {
              background-color: #fff;
              color: #097F94;
              padding: 20px;
              border-radius: 10px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              text-align: center;
            }
          </style>
          <script>
            setTimeout(function() {
              window.location.href = "loginpage.php";
            }, 5000); // Redirect after 5 seconds
          </script>
        </head>
        <body>
          <div class="message-box">
            <h1>Account Successfully Created!</h1>
            <p>You will be redirected to the login page shortly.</p>
          </div>
        </body>
        </html>';
    } else {
        echo "Error: " . $stmtLogin->error;
    }
    
    $stmtLogin->close();
} else {
    echo "Error: " . $stmtBasic->error;
}

$stmtBasic->close();
$dbconn->close();
?>
