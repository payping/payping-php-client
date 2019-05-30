<?php
include "../../vendor/autoload.php";

$token = "07d2bd1c2c4fc148e315dc2e16a85395d58a68431c021ec854e80c4825337221";

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