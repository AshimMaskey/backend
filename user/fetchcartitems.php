<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../dbconnect.php";
$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->user_id)) {
    $user_id = $data->user_id;

    $sql = "SELECT image_url, cart.game_id, game_title, genre, price FROM cart INNER JOIN games ON cart.game_id = games.game_id WHERE cart.user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }
        echo json_encode($cartItems);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(["error" => "user_id not provided"]);
}
$conn->close();
?>





