<?php
include "../../vendor/autoload.php";

$token = "1200ed8684b98d8caad79406fa4471839574571f7e10aa58d9f281dd1dd88edd";

$args = [
    "amount" => 100,
//    "payerIdentity" => "",
    "payerName" => "farhad",
    "description" => "this is for show",
    "returnUrl" => "http://localhost:8000/callback.php",
    "clientRefId" => "inv-1000"
];

$payment = new \PayPing\Payment($token);

try {
    $payment->pay($args);
} catch (Exception $e) {
    var_dump($e->getMessage());
}
//echo $payment->getPayUrl();

header('Location: ' . $payment->getPayUrl());
