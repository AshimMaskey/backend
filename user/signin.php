<?php
require_once '../dbconnect.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $data = file_get_contents('php://input');
    $values = json_decode($data, true);

    $username = $values['username'];
    $password = $values['password'];

    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";

    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        
        // Check user status
        if ($row['status'] == 0) {
            header('Content-Type:application/json');
            echo json_encode(array('success' => false, 'message' => 'User account is disabled'));
            exit();
        }

        // Check pass correc
        if($row['password'] === $password){
            header('Content-Type:application/json');
            echo json_encode(array('success' => true, 'user' => $row));
            exit();
        } else {
            header('Content-Type:application/json');
            echo json_encode(array('success' => false, 'message' => 'Invalid password'));
            exit();
        }
    } else {
        header('Content-Type:application/json');
        echo json_encode(array('success' => false, 'message' => 'User not found'));
        exit();
    }

    mysqli_free_result($result);
}
?>
