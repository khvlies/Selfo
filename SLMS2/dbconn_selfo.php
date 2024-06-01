<?php
/* php & mysql db connection file */
$user = "root"; //mysql username
$pass = ""; //mysql password
$host = "localhost"; //server name or ip address
$dbname = "educationdb"; //your db name	

//Create connection
$dbconn = mysqli_connect($host, $user, $pass, $dbname) or die (mysqli_error($dbconn));

?>