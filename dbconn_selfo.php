<?php
/* php & mysql db connection file */
$user = "root"; //mysql username
$pass = ""; //mysql password
$host = "localhost"; //server name or ip address
$dbname = "educationdb"; //your db name	
//$dbconn = mysql_connect($host, $user, $pass);
$dbconn = mysqli_connect($host, $user, $pass, $dbname) die(mysqli_error($dbconn));

?>