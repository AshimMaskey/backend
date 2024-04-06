<?php
$servername="localhost";
$uname="root";
$pass="";
$dbname="onlinegamestore";

//create connection
$conn=new mysqli($servername,$uname,$pass,$dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
  }
?>