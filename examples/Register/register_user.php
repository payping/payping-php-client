<?php
include "../../vendor/autoload.php";

$token = "توکن اختصاصی";

$register = new \PayPing\Register($token);

$params = [
    "UserName" => "نام کاربری",
    "Email" => "ایمیل - اجباری",   
    "FirstName" => "نام کوچک",
    "LastName" => "نام خانوادگی",
    "PhoneNumber" => "شماره تلفن",
    "NationalCode" => "کد ملی",
    "BirthDay" => "تاریخ تولد",
    "Sheba" => "شناسه شبا"
];
try {
    $register_id = $register->registerUser("آدرس برگشتی هنگام تکمیل ثبت نام در پی پینگ", $params);
  header("Location: ".$register->getRegisterUrl());
}catch (Exception $e){
    echo $e->getMessage();
}
