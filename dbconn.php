
<?php

$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "scienceLab"; 

$dbconn = mysqli_connect($hostname, $username, $password, $dbname);


if (mysqli_connect_errno())
{
	echo "failed to connect to MySQLi: " . mysqli_connect_error();
}

?>