<?php
require_once "../dbconnect.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data)) {
    $transaction_code = $data['transaction_code'];
    $product_code = $data['product_code'];
    $status = $data['status'];
    $user_id = $data['user_id'];
    $amount = $data['total_amount'];
    $game_ids = $data['gameids']; // Array of game IDs

    // Check if transaction_code already exists
    $check_sql = "SELECT * FROM payments WHERE transaction_code = '$transaction_code'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Transaction code already exists, handle this case (e.g., return an error)
        echo json_encode(["error" => "Transaction code already exists"]);
    } else {
        // Insert payment data
        $sql = "INSERT INTO payments (transaction_code, product_code, status, user_id, amount)
                VALUES ('$transaction_code', '$product_code', '$status', '$user_id', '$amount')";

        if ($conn->query($sql) === TRUE) {
            $payment_id = $conn->insert_id; // Get the last inserted ID

            // Insert payment items
            foreach ($game_ids as $game_id) {
                $sql_item = "INSERT INTO payment_items (payment_id, game_id) VALUES ('$payment_id', '$game_id')";
                if (!$conn->query($sql_item)) {
                    echo json_encode(["error" => "Error: " . $sql_item . "<br>" . $conn->error]);
                    $conn->close();
                    exit;
                }
            }

            // Fetch download links for purchased games
            $download_links = [];
            foreach ($game_ids as $game_id) {
                $sql_game = "SELECT game_title, download_url FROM games WHERE game_id = '$game_id'";
                $result = $conn->query($sql_game);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $download_links[] = [
                        "game_title" => $row['game_title'],
                        "download_link" => $row['download_url']
                    ];
                }
            }

            echo json_encode([
                "message" => "New record created successfully",
                "download_links" => $download_links
            ]);
        } else {
            echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
        }
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$conn->close();
?>
