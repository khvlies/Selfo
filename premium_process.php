<?php
include("dbconn_selfo.php");

$p_pass = mysqli_real_escape_string($dbconn, $_REQUEST['premiumpass']);
$p_name = mysqli_real_escape_string($dbconn, $_REQUEST['premiumname']);
$p_phone = mysqli_real_escape_string($dbconn, $_REQUEST['premiumphone']);
$p_email = mysqli_real_escape_string($dbconn, $_REQUEST['premiumemail']);

$sqlInsertPremium = "INSERT INTO premium_user (premium_password, premium_name, premium_phone, premium_email) VALUES (?, ?, ?, ?, ?)";
$stmtPremium = $dbconn->prepare($sqlInsertPremium);
$stmtPremium->bind_param("sssss",$p_pass, $p_name, $p_phone, $p_email);

if ($stmtPremium->execute()) {
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
 else {
    echo "Error: " . $stmtPremium->error;
}

$stmtPremium->close();
$dbconn->close();
?>