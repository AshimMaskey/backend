<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../dbconnect.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($data->game_id) && isset($data->user_id)) {       
        $gameId = $data->game_id;
        $userId = $data->user_id;         
        
        // if game is already in cart
        $checkSql = "SELECT * FROM cart WHERE user_id = $userId AND game_id = $gameId";
        $result = $conn->query($checkSql);
        
        if ($result->num_rows > 0) {
            echo json_encode(array("success" => false, "message" => "Game already added to cart"));
        } else {
            // insert game in cart
            $sql = "INSERT INTO cart (user_id, game_id) VALUES ($userId, $gameId)";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("success" => true, "message" => "Game added to cart successfully"));
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to add game to cart: " . $conn->error));
            }
        }        
        $conn->close();
    } else {
        echo json_encode(array("success" => false, "message" => "Missing game_id or user_id"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
