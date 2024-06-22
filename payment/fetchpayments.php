<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$sql = "SELECT * FROM payments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $paymentsData = array();
    while ($row = $result->fetch_assoc()) {
        $paymentsData[] = $row;
    }
    echo json_encode($paymentsData);
} else {
    echo json_encode(array());
}

$conn->close();
?>
