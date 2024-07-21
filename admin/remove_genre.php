<?php
require_once '../dbconnect.php';

// CORS headers
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: Content-Type");

// Handle DELETE requests

    $genre_id = $_GET['id'];
    $genre_id = $conn->real_escape_string($genre_id);

    $sql = "DELETE FROM genres WHERE id = '$genre_id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("success" => true, "message" => "Genre deleted successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to delete genre: " . mysqli_error($conn)));
    }

$conn->close();
?>
