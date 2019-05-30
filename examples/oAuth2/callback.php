<?php


include "../../vendor/autoload.php";

$client_id = "318b6954-2f9f-4100-8610-0ea8c373d3b5"; // TODO remove it
$client_secret = "4b9c8835-f833-42d0-aa5f-47324e8c358a"; // TODO remove it
$codeVerify = 'A0GNGBUtNorqkfaHyXf4OefxSVUGDxhtB-AHJlVt0H8';//generateVerified();
$callback = "http://localhost:8000/callback.php";



$auth = new PayPing\Authorization($client_id,$client_secret,$callback,$codeVerify);
try {
    var_dump($auth->getAccessToken("http://localhost:8000/callback.php", $codeVerify));
} catch (Exception $exception) {
    echo $exception->getMessage();
}

