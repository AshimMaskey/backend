<?php
require_once '../dbconnect.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $game_id = $_GET['game_id'];

    $sql = "DELETE FROM games WHERE game_id = $game_id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("message" => "game deleted successfully"));
    } else {
       
        echo json_encode(array("message" => "Failed to delete game"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
