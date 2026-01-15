<?php
$data = json_decode(file_get_contents("php://input"), true);

$orderID = $data['orderID'];

// Here you verify order from PayPal API (secure way)
// After verification:

session_start();
$_SESSION['pro_user'] = true;

echo json_encode([
  "status" => "success"
]);
?>
