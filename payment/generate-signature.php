<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $secretKey = '8gBm/:&EnhH.1/q';
    $message = "total_amount={$data['total_amount']},transaction_uuid={$data['transaction_uuid']},product_code={$data['product_code']}";
    $signature = base64_encode(hash_hmac('sha256', $message, $secretKey, true));
    echo json_encode(['signature' => $signature]);
}
?>
