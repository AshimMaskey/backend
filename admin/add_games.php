<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $genre = $_POST['genre'];
  $releaseDate = $_POST['releaseDate'];
  
  // image file
  $image = $_FILES['image'];
  $imageFileName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
  $targetDirectory = "uploadsgame/"; 
  $targetFilePath = $targetDirectory . uniqid() . '.' . $imageFileType; 
  move_uploaded_file($imageTmpName, $targetFilePath);

  //APK file
  $apk = $_FILES['apk'];
  $apkFileName = $apk['name'];
  $apkTmpName = $apk['tmp_name'];
  $apkFileType = strtolower(pathinfo($apkFileName, PATHINFO_EXTENSION));
  $targetFilePathApk = $targetDirectory . uniqid() . '.' . $apkFileType; 
  move_uploaded_file($apkTmpName, $targetFilePathApk);

  // Insert data into database
  $sql = "INSERT INTO games (game_title, description, price, genre, release_date, image_url, download_url) 
          VALUES ('$title', '$description', '$price', '$genre', '$releaseDate', '$targetFilePath', '$targetFilePathApk')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } 

  $conn->close();
}
?>
