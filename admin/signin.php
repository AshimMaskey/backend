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

	$admin_name=$values['admin_name'];
	$password=$values['password'];

	$query= "SELECT * FROM admin WHERE admin_name='$admin_name' LIMIT 1";

	$result = mysqli_query($conn, $query);

	if($result && mysqli_num_rows($result)>0){
		$row=mysqli_fetch_assoc($result);
		if($row['password']===$password){
			header('Content-Type:application/json');
			echo json_encode(array('success' => true, 'admin'=>$row));
            exit();
		}else{
			header('Content-Type:application/json');
			echo json_encode(array('success'=>false, 'message'=>'Invalid admin name or password'));
		}
	}
	else{
		header('Content-Type:application/json');
		echo json_encode(array('success'=>false, 'message'=>'Invalid admin name or password'));
	}

	mysqli_free_result($result);
}

?>