<?php


namespace PayPing;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Payment
{

    const BASE_URL = 'https://api.payping.ir/v1/';

    private $token = "";

    /**
     * کتابخانه guzzle برای فرخوانی وب سرویس ها
     * @var Client
     */
    private $restCall;

    /**
     * آدرس ساخته شده توسط payping برای هدایت کاربر به درگاه
     * @var string $payUrl
     */
    private $payUrl;

    /**
     * Payment constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;

        $headers = [
            'Content-type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];


        $this->restCall = new Client([
            'base_uri' => self::BASE_URL,
            'headers' => $headers
        ]);
    }

    /**
     * ایجاد یک پرداخت
     * @param array $params
     * @throws PayPingException
     */
    public function pay(array $params)
    {
        try {
            $result = $this->restCall->post(self::BASE_URL . 'pay', ['body' => json_encode($params)]);
            $result = json_decode($result->getBody()->getContents(), false);
            if (!isset($result->code))
                throw new PayPingException('error in get code from payping', 0);

            $this->payUrl = self::BASE_URL . 'pay/gotoipg/' . $result->code;
        } catch (\Exception $exception) {
            throw new PayPingException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

    /**
     * دریافت ادرس درگاه پرداخت
     * @return string
     */
    public function getPayUrl()
    {
        return $this->payUrl;
    }

    /**
     * تایید یک پرداخت
     * اگر exception پرتاب نشود پرداخت درست بوده است
     * @param $refId
     * @param $amount
     * @return bool
     * @throws PayPingException
     */
    public function verify($refId, $amount)
    {
        $params = [
            'refId' => $refId,
            'amount' => $amount
        ];
        try {
            $result = $this->restCall->post(self::BASE_URL . 'pay/verify', ['body' => json_encode($params)]);
            if ($result->getStatusCode() >= 200 && $result->getStatusCode() < 300) {
                return true;
            }
        } catch (RequestException $re) {
            throw new PayPingException($re->getResponse()->getBody()->getContents(), $re->getResponse()->getStatusCode(), $re->getPrevious());
        } catch (\Exception $e) {
            throw new PayPingException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

}