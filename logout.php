<?php 
/*end session and log out*/
session_start();
session_unset();
session_destroy();

header("Location:loginpage.php");
exit();
?>