<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Fetch news data from the database
$sql = "SELECT * FROM news";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $newsData = array();
    while ($row = $result->fetch_assoc()) {
        $newsData[] = $row;
    }
    echo json_encode($newsData);
} else {
    echo json_encode(array()); // Return empty array if no data found
}

$conn->close();
?>
