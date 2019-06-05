<?php
include "../../vendor/autoload.php";

$token = "توکن اختصاصی";

$payment = new \PayPing\Payment($token);

try {
    if($payment->verify($_GET['refid'], 100)){
        echo "success";
    }else{
        echo "fail";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}