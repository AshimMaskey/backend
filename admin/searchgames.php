<?php
require_once "../dbconnect.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

$searchQuery = $_GET['searchQuery'];

$sql = "SELECT * FROM games WHERE game_title LIKE '%$searchQuery%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
     $searchResults = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
    echo json_encode($searchResults);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>
