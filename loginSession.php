<?php
session_start();
## include db connection file 
include("dbconn_selfo.php");

if(isset($_POST['Submit'])){
    # capture values from HTML form 
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

	## execute SQL command to check if the user is an administrator
    $sql_admin = "SELECT * FROM admins WHERE admin_id= '$username' AND admin_password= '$password' ";
    $query_admin = mysqli_query($dbconn, $sql_admin) or die("Error: " . mysqli_error($dbconn));
    $rows_admin = mysqli_num_rows($query_admin);
    
    ## check if the user is an administrator
    if($rows_admin > 0){
        ## set the session’s username as administrator
		$_SESSION['username'] = $username;
		$_SESSION['role'] = "Administrator";
		header("Location: adminMainpage.php");
		exit();
    }
	##if the user is not an admin, check if the user is a tutor, basic or premium user
	else { 
        ## Check if the user is a tutor
        $sql = "SELECT * FROM tutor WHERE tutor_id = '$username' AND tutor_password = '$password'";
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
        $row = mysqli_num_rows($query);

        if($row > 0){  
            ## User is a tutor
            $r = mysqli_fetch_assoc($query);
            $_SESSION['tutor_id'] = $r['tutor_id'];
            $_SESSION['tutor_name'] = $r['tutor_name'];
            ## directly open the page menu 
            header("Location: tutorMainpage.php");
            exit();
        } else {
            ## Check if the user is a premium user
            $sql = "SELECT * FROM premium_user WHERE premium_id = '$username' AND premium_password = '$password'";
            $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
            $row = mysqli_num_rows($query);

            if($row > 0){  
                ## User is a premium user
                $r = mysqli_fetch_assoc($query);
                $_SESSION['premium_id'] = $r['premium_id'];
                $_SESSION['premium_name'] = $r['premium_name'];
                ## directly open the page menu 
                header("Location: premiumMainpage.php");
                exit();
            } else {
                ## Check if the user is a basic user
                $sql = "SELECT * FROM basic_user WHERE basic_id = '$username' AND basic_password = '$password'";
                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row = mysqli_num_rows($query);

                if($row > 0){  
                    ## User is a basic user
                    $r = mysqli_fetch_assoc($query);
                    $_SESSION['basic_id'] = $r['basic_id'];
                    $_SESSION['basic_name'] = $r['basic_name'];
                    ## directly open the page menu 
                    header("Location: basicMainpage.php");
                    exit();
                } else {
                    ## if the user's record does not exist
                    header("Location: loginpage.php");
                    exit();
                }
            }
        }
    }
	header("Location: loginpage.php");
}
mysqli_close($dbconn); //close connection
?>