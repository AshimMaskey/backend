<?php
require '../dbconnect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// Collect POST data
$game_id = $_POST['game_id'];
$game_title = $_POST['game_title'];
$price = $_POST['price'];
$genre = $_POST['genre'];
$release_date = $_POST['release_date'];
$description = $_POST['description'];

// File upload paths
$imagePath = null;
$apkPath = null;

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imagePath = 'uploadsgame/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}

// Handle APK upload
if (isset($_FILES['apk']) && $_FILES['apk']['error'] == 0) {
    $apkPath = 'uploadsgame/' . basename($_FILES['apk']['name']);
    move_uploaded_file($_FILES['apk']['tmp_name'], $apkPath);
}

// Update query
$sql = "UPDATE games SET 
        game_title = '$game_title', 
        price = '$price', 
        genre = '$genre', 
        release_date = '$release_date', 
        description = '$description'" . 
        ($imagePath ? ", image_url = '$imagePath'" : "") . 
        ($apkPath ? ", download_url = '$apkPath'" : "") . 
        " WHERE game_id = $game_id";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["message" => "Game updated successfully"]);
} else {
  echo json_encode(["error" => "Error updating record: " . $conn->error]);
}

$conn->close();
?>
