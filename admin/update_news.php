<?php
require '../dbconnect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$author = $_POST['author'];
$news_id = $_POST['id'];

$image = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($image);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'File is not an image.']);
        exit;
    }

    // Check file size (limit to 2MB)
    if ($_FILES['image']['size'] > 2000000) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file is too large.']);
        exit;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo json_encode(['success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
        exit;
    }

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        echo json_encode(['success' => false, 'message' => 'Sorry, there was an error uploading your file.']);
        exit;
    }
}

$query = "UPDATE news SET title = '$title', description = '$description', date = '$date', Author = '$author'" . ($image ? ", image_url = '$image'" : "") . " WHERE news_id = $news_id";

if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update news.']);
}

$conn->close();
?>
