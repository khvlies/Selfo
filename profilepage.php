<?php
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
  <link rel="stylesheet" href="css/profile.css">
</head>
<body>
  <div class="header">
    <div class="logo">
      <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
    </div>
  </div>

  <div class="main-content">
    <div class="picture">
      <img src="images/profile.png" id="profile-pic">
    </div>
    <div class="profile-info">
      <form action="profile_update.php" method="post">
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter User Name" name="name" value="<?php echo htmlspecialchars($user['admin_name'] ?? $user['tutor_name'] ?? $user['premium_name'] ?? $user['basic_name'] ?? ''); ?>" required>

        <label for="phoneno"><b>Phone Number</b></label>
        <input type="tel" placeholder="Enter Phone Number" name="phoneno" value="<?php echo htmlspecialchars($user['admin_phone'] ?? $user['tutor_phone'] ?? $user['premium_phone'] ?? $user['basic_phone'] ?? ''); ?>" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" value="<?php echo htmlspecialchars($user['admin_email'] ?? $user['tutor_email'] ?? $user['premium_email'] ?? $user['basic_email'] ?? ''); ?>" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" value="<?php echo htmlspecialchars($user['admin_password'] ?? $user['tutor_password'] ?? $user['premium_password'] ?? $user['basic_password'] ?? ''); ?>" id="psw" disabled>

        <div class="clearfix updateprofile-button">
          <button type="submit" class="edit-button">Update</button>
          <span style="margin: 0 10px;"></span>
          <button type="button" class="cancel-button" onclick="window.location.href='<?php echo htmlspecialchars($mainPageURL); ?>';">Cancel</button>
        </div>
      </form>
    </div>
  </div>
<script>
  /*let profilePic = document.getElementById("profile-pic");
  let inputFile = document.getElementById("input-file");

  inputFile.onchange = function(){
    profilePic.src = URL.createObjectURL(inputFile.files[0]);
  }*/
</script> 
</body>
</html>
