<?php
$dbhostname = "localhost";
$dbusername = "MYSQL USER";
$dbpassword = "MYSQL PASSWORD";
$dbname = "DB_NAME";
//establish the connection with the database server
$myconnection = mysqli_connect($dbhostname, $dbusername, $dbpassword) or die ("Unable to connect to server" . mysqli_error());
//connect to the database
$blnConnected = mysqli_select_db ($dbname, $myconnection) or die("Unable to connect to database" . mysqli_error());
?>

