<?php
session_start();
## include db connection file 
include("dbconn_selfo.php");

if(isset($_POST['Submit'])){
    # capture values from HTML form 
    $username = $_POST['username'];
    $password = $_POST['password'];

    # verify if the values of username and password are correct
    if($username == "admin" && $password == "admin"){
        ## set the session’s username as administrator
        $_SESSION['username'] = "Administrator";
        ## directly open the page for menuAdmin 
        header("Location: adminMainpage.php");
    }
        
	##If the user is not an admin, then check if the user is a tutor
	if else{ 
			## execute SQL command 
			$sql= "SELECT * FROM tutor WHERE tutor_id= '$username' AND tutor_password= '$password'";
			$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
			$row = mysqli_num_rows($query);

			#to verify the tutor’s information exist in the db
			if($row == 0){  
				##if the user’s record is not exist
				header("Location: loginpage.php");
			}else{
				
				$r = mysqli_fetch_assoc($query);
				$_SESSION['tutor_id'] = $r['tutor_id'];
				$_SESSION['tutor_name'] = $r['tutor_name'];
				##directly open the page menu 
				header("Location: tutorMainpage.php");
			}
	}
	##If the user not and admin or tutor, check if the user is a premium user
	if else{
			## execute SQL command 
			$sql= "SELECT * FROM premium_user WHERE premium_id= '$username' AND premium_password= '$password'";
			$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
			$row = mysqli_num_rows($query);

			#to verify the tutor’s information exist in the db
			if($row == 0){  
				##if the user’s record is not exist
				header("Location: loginpage.php");
			}else{
				
				$r = mysqli_fetch_assoc($query);
				$_SESSION['premium_id'] = $r['premium_id'];
				$_SESSION['premium_name'] = $r['premium_name'];
				##directly open the page menu 
				header("Location: premiumMainpage.php");
			}
	}
	else{
		## execute SQL command 
		$sql= "SELECT * FROM basir_user WHERE basic_id= '$username' AND basic_password= '$password'";
		$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
		$row = mysqli_num_rows($query);

		#to verify the tutor’s information exist in the db
		if($row == 0){  
			##if the user’s record is not exist
			header("Location: loginpage.php");
		}else{
			
			$r = mysqli_fetch_assoc($query);
			$_SESSION['basic_id'] = $r['basic_id'];
			$_SESSION['basic_name'] = $r['basic_name'];
			##directly open the page menu 
			header("Location: basicMainpage.php");
		}
	}
}
mysqli_close($dbconn); //close connection
?>
