<?php
require_once '../dbconnect.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if($_SERVER['REQUEST_METHOD']==='POST')
{
	$data=file_get_contents('php://input');
	$values=json_decode($data,true);

	$username=$values['username'];
	$password=$values['password'];

	$query= "SELECT user_id, username, password FROM users WHERE username='$username' LIMIT 1";

	$result = mysqli_query($conn, $query);

	if($result && mysqli_num_rows($result)>0){
		$row=mysqli_fetch_assoc($result);
		if($row['password']===$password){
			header('Content-Type:application/json');
			echo json_encode(array('success' => true));
            exit();
		}else{
			header('Content-Type:application/json');
			echo json_encode(array('success'=>false, 'message'=>'Invalid password'));
		}
	}
	else{
		header('Content-Type:application/json');
		echo json_encode(array('success'=>false, 'message'=>'User not found'));
	}

	mysqli_free_result($result);
}

?>