<?php
require_once '../dbconnect.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $news_id = $_GET['news_id'];

    $sql = "DELETE FROM news WHERE news_id = $news_id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("message" => "news deleted successfully"));
    } else {
       
        echo json_encode(array("message" => "Failed to delete news"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
