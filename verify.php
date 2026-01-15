<?php

$data = json_decode(file_get_contents("php://input"), true);
$orderID = $data['orderID'];

// PAYPAL API VERIFY
$clientId = "ATsTDg8o88cVJJL5YPUCzySw_F_NeVAqCclxW17v8jvxiUoUiQjwck8vM4ZxrxYhuLV0apKT4Vru7uV2";
$secret = "EG-RN4MWmdEW8wCkj-fEdNNSeccJfNcO4-ys96gdANb7z1EhW1orWfApN1TjCW43o44FWuOCmxUEXdyT";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderID");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);

$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

if($response['status'] == "COMPLETED"){

    session_start();
    $_SESSION['pro_user'] = true;

    echo json_encode(["status"=>"success"]);

}else{
    echo json_encode(["status"=>"failed"]);
}
?>
