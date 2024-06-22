<?php
require_once "../dbconnect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$sql = "SELECT * FROM payment_items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $paymentitems = array();
    while ($row = $result->fetch_assoc()) {
        $paymentitems[] = $row;
    }
    echo json_encode($paymentitems);
} else {
    echo json_encode(array());
}

$conn->close();
?>
