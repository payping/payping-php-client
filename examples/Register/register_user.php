<?php
include "../../vendor/autoload.php";

$token = "1200ed8684b98d8caad79406fa4471839574571f7e10aa58d9f281dd1dd88edd";

$register = new \PayPing\Register($token);

$params = [
    "UserName" => "farhadlg",
    "Email" => "sebu@planet-travel.club",   //اجباری
    "FirstName" => "string",
    "LastName" => "string",
    "PhoneNumber" => "string",
    "NationalCode" => "string",
    "BirthDay" => "2000-02-02",
    "Sheba" => "string"
];
try {
    $register_id = $register->registerUser("http://localhost:8000/callback.php", $params);
    header("Location: ".$register->getRegisterUrl());
}catch (Exception $e){
    echo $e->getMessage();
}

