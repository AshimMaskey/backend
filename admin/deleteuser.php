<?php
require_once '../dbconnect.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $userId = $_GET['id'];

    $sql = "DELETE FROM users WHERE user_id = $userId";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("message" => "User deleted successfully"));
    } else {
       
        echo json_encode(array("message" => "Failed to delete user"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
