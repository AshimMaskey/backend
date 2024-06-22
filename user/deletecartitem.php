<?php
require_once '../dbconnect.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->user_id) && isset($data->game_id)) {
        $user_id = $data->user_id;
        $game_id = $data->game_id;

        $query = "DELETE FROM cart WHERE user_id = $user_id AND game_id = $game_id";

        if (mysqli_query($conn, $query)) {
            echo json_encode(array("message" => "Cart item deleted successfully"));
        } else {
            echo json_encode(array("message" => "Unable to delete cart item"));
        }
    } else {
        echo json_encode(array("message" => "Missing user_id or game_id in request"));
    }
} else {
    echo json_encode(array("message" => "Invalid request method"));
}

?>
