<?php
require_once "../dbconnect.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Read the input JSON data
$input = json_decode(file_get_contents("php://input"), true);

// Check if genre name is provided
if (!isset($input['name']) || empty($input['name'])) {
    echo json_encode(array('success' => false, 'message' => 'Genre name is required.'));
    exit();
}

$genreName = $conn->real_escape_string($input['name']);

// Insert the new genre into the database
$sql = "INSERT INTO genres (genre) VALUES ('$genreName')";

if ($conn->query($sql) === TRUE) {
    $genreId = $conn->insert_id; // Get the ID of the newly inserted genre
    // Successfully inserted
    echo json_encode(array('success' => true, 'id' => $genreId, 'genre' => $genreName));
} else {
    // Error occurred
    echo json_encode(array('success' => false, 'message' => 'Error adding genre: ' . $conn->error));
}

$conn->close();
?>
