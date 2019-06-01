<?php
include "../../vendor/autoload.php";

$token = "1200ed8684b98d8caad79406fa4471839574571f7e10aa58d9f281dd1dd88edd";

$register = new \PayPing\Register($token);

var_dump($register->checkEmail("sebu@planet-travel.club"));
