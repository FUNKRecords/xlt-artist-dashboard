<?php

$data = json_decode(file_get_contents("php://input"), true);
$orderID = $data['orderID'];

// PAYPAL API VERIFY
$clientId = "xxx";
$secret = "xxx";

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
