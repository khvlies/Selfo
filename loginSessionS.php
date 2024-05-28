<?php
session_start();
## include db connection file 
include("dbconn_selfo.php");

if(isset($_POST['Submit'])){
    ## capture values from HTML form 
    $username = $_POST['username'];
    $password = $_POST['password'];

    ## verify if the values of username and password are correct
    if($username == "admin" && $password == "admin"){
        ## set the session’s username as administrator
        $_SESSION['username'] = "Administrator";
        ## directly call / open the page for menuAdmin 
        header("Location: mainAdminSessionS.php");
    }
        
##If the user is not an admin, then , call find the user’s information
else{ 
	## execute SQL command 
		$sql= "SELECT * FROM login WHERE USERNAME= '$username' AND PASSWORD= '$password'";

		$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
		$row = mysqli_num_rows($query);
		##to verify the user’s information exist in the db
		if($row == 0){  ##if the user’s record is not exist
			echo "Invalid Username/Password. Click here to <a href='login.php'>login</a>.";
		}else{##if the user’s record is not exist
			 ##retrieve the user’s infor detail 
			$r = mysqli_fetch_assoc($query);
			 ##ser the session name with the current user’s info
			$_SESSION['username'] = $r['USERNAME'];
			 ##directly open the page menu 
			header("Location: mainSessionS.php");
		}
	}
}
mysqli_close($dbconn);
?>
