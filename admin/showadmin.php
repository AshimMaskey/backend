<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../dbconnect.php"; 

$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $adminData = array();
    while($row = $result->fetch_assoc()) {
        $adminData[] = $row;
    }
    echo json_encode($adminData);
} else {
    echo json_encode(array());
}

$conn->close();
?>