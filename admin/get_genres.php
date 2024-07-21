<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$sql = "SELECT * FROM genres";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $genres = array();
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
    echo json_encode($genres);
} else {
    echo json_encode(array());
}

$conn->close();
?>
