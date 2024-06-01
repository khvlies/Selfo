<?php
include("dbconn_selfo.php");

$b_name = mysqli_real_escape_string($dbconn, $_REQUEST['premiumname']);
$b_id = mysqli_real_escape_string($dbconn, $_REQUEST['premiumid']);
$b_pass = mysqli_real_escape_string($dbconn, $_REQUEST['premiumpass']);
$b_phone = mysqli_real_escape_string($dbconn, $_REQUEST['premiumphone']);
$b_email = mysqli_real_escape_string($dbconn, $_REQUEST['premiumemail']);

$sqlInsert = "INSERT INTO premium_user (premium_name, premium_id, premium_password, premium_phone, premium_email) VALUES (?, ?, ?, ?, ?)";
$stmt = $dbconn->prepare($sqlInsert);
$stmt->bind_param("sssss", $b_name, $b_id, $b_pass, $b_phone, $b_email);

if ($stmt->execute()) {
    echo'<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    echo "Error: " . $stmt->error;
}

$stmt->close();
$dbconn->close();
?>
