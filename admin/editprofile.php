<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../dbconnect.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

$admin_id=$data->admin_id;
$admin_name=$data->admin_name;
$email=$data->email;
$phone=$data->phone;
$dob=$data->dob;
$password=$data->password;

$sql="UPDATE admin SET admin_name='$admin_name', email='$email', phone='$phone', date_of_birth='$dob', password='$password' WHERE admin_id=$admin_id";
if ($conn->query($sql) === TRUE) {
	echo json_encode(array('success' => true));
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
