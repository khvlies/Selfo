<?php
session_start();
## include db connection file 
include("dbconn_selfo.php");

if(isset($_POST['Submit'])){
    # capture values from HTML form 
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    # verify if the values of username and password are correct
    if($username == "admin" && $password == "admin"){
        ## set the session’s username as administrator
        $_SESSION['username'] = "Administrator";
        ## directly open the page for menuAdmin 
        header("Location: adminMainpage.php");
        exit();
    } else { 
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
}
mysqli_close($dbconn); //close connection
?>
