<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$sql = "SELECT * FROM news";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $newsData = array();
    while ($row = $result->fetch_assoc()) {
        $newsData[] = $row;
    }
    echo json_encode($newsData);
} else {
    echo json_encode(array());
}

$conn->close();
?>
