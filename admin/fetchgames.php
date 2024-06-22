<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$sql = "SELECT * FROM games";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $newsData = array();
    while ($row = $result->fetch_assoc()) {
        $gamesData[] = $row;
    }
    echo json_encode($gamesData);
} else {
    echo json_encode(array());
}

$conn->close();
?>
