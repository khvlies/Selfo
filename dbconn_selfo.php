<?php
/* php & mysql db connection file */
$user = "root"; //mysql username
$pass = ""; //mysql password
$host = "localhost"; //server name or ip address
$dbname = "educationdb"; //your db name	

//Create connection
$dbconn = mysqli_connect($host, $user, $pass, $dbname) 

//Check connection
if (!$dbconn){
    die("Connection failed: "mysqli_error());
}
?>