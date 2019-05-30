<?php
include "../../vendor/autoload.php";

$token = "07d2bd1c2c4fc148e315dc2e16a85395d58a68431c021ec854e80c4825337221";

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
