<?php


include "../../vendor/autoload.php";

$client_id = "cleint-id"; 
$client_secret = "cleint-secret"; 
$codeVerify = 'شناسه یکتا به ازای هر کاربر';//generateVerified();
$callback = "http://localhost:8000/callback.php";



$auth = new PayPing\Authorization($client_id,$client_secret,$callback,$codeVerify);
try {
	echo '<pre>';
    print_r($auth->getAccessToken($callback, $codeVerify));
} catch (Exception $exception) {
    echo $exception->getMessage();
}

