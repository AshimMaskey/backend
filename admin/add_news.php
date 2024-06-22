<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


if($_SERVER['REQUEST_METHOD']==='POST'){
	$title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $author = $_POST["author"];
    $sourceLink = $_POST["sourceLink"];

	if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

			$sql = "INSERT INTO news (title, description, date, Author, link, image_url) VALUES ('$title', '$description', '$date', '$author', '$sourceLink', '$target_file')";

			// Execute SQL query
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}else{
				echo "there was error uploading file";
			}
	}
	else{
		echo "no image file was uploaded";
	}
}
?>