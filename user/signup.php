<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


if($_SERVER['REQUEST_METHOD']==='POST'){
	$data=file_get_contents('php://input');
	$values=json_decode($data,true);

	$username = $values['username'];
    $email = $values['email'];
    $dob = $values['dob'];
    $phone = $values['phone'];
    $password = $values['password'];


    require_once "../dbconnect.php";
	$sql = "INSERT INTO users (username, email, date_of_birth, phone, password) VALUES ('$username', '$email', '$dob', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>