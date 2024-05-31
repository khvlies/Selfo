<?php
session_start();
include("dbconn_Selfo.php");
if(isset($_POST['Submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
}
    $sql = "SELECT * FROM login WHERE USERNAME = '$username' AND PASSWORD = '$password' AND ROLE = '$role'";
    $query = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
    $row = mysqli_num_rows($query);

    if($row == 0){
        echo "Invalid Username/Password. Click here to <a href='loginpage.php'>login</a>.";
    } else {
        $r = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $r['USERNAME'];

        if($role == 'tutor'){
            header("Location: mainTutorSessionS.php");
        } elseif ($role == 'basic_user') {
            header("Location: mainSessionS.php");
		} elseif ($role == 'premium_user') {
            header("Location: mainPremiumSessionS.php");
        } elseif ($role == 'admin') {
            header("Location: mainAdminSessionS.php");
        } else {
            header("Location: location.php");
        }
        exit();
    }

?>
