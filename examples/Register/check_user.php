<?php
include "../../vendor/autoload.php";

$token = "توکن اختصاصی";

$register = new \PayPing\Register($token);

var_dump($register->checkEmail("ایمیل مورد نظر"));
