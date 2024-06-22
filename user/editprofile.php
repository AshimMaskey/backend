<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../dbconnect.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

$user_id=$data->user_id;
$username=$data->username;
$email=$data->email;
$phone=$data->phone;
$dob=$data->dob;
$password=$data->password;

$sql="UPDATE users SET username='$username', email='$email', phone='$phone', date_of_birth='$dob', password='$password' WHERE user_id=$user_id";
if ($conn->query($sql) === TRUE) {
	echo json_encode(array('success' => true));
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>