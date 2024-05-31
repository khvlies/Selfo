<?php
    session_start();

    #Get user data
	$name = $_POST['name'];
    $uname = $_POST['uname'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $plan = $_POST['plan'];
	
    #Store user data in session variables
    $_SESSION['name'] = $name;
    $_SESSION['uname'] = $uname;
    $_SESSION['phoneno'] = $phoneno;
    $_SESSION['email'] = $email;
    $_SESSION['plan'] = $plan;

    header("Location: confirm.php");
    exit();
?>