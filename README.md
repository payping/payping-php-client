# payping-client

payment and oauth2 request library for payping

## نحوه استفاده
### نصب
``composer require flotfeali/payping-client``

### درخواست پرداخت
```php
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
```

### تایید پرداخت
```php
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
``` 
