<?php
include "../../vendor/autoload.php";

$token = "توکن اختصاصی ";
$args = [
    "amount" => میلغ تراکنش,
    "payerIdentity" => "شناسه کاربر در صورت وجود",
    "payerName" => "نام کاربر پرداخت کننده",
    "description" => "توضیحات",
    "returnUrl" => "آدرس برگشتی از سمت درگاه",
    "clientRefId" => "شماره فاکتور"
];

$payment = new \PayPing\Payment($token);

try {
    $payment->pay($args);
} catch (Exception $e) {
    var_dump($e->getMessage());
}
//echo $payment->getPayUrl();

header('Location: ' . $payment->getPayUrl());
