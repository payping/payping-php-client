<?php

include "../../vendor/autoload.php";

$client_id = "cleint-id"; 
$client_secret = "cleint-secret"; 
$codeVerify = 'شناسه یکتا به ازای هر کاربر';//generateVerified();
$callback = "http://localhost:8000/callback.php";
$scopes = [PayPing\Scopes::OPENID,PayPing\Scopes::PROFILE];


try {
    $auth = new PayPing\Authorization($client_id, $client_secret, $callback, $codeVerify);
    echo '<a href="' . $auth->getAuthLink() . '" >login with payping</a>' . "<br>";
} catch (Exception $exception) {
    echo $exception->getMessage();
}