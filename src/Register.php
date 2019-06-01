<?php


namespace PayPing;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Register
{

    const BASE_URL = 'https://oauth.payping.ir/';

    private $token = "";

    /**
     * کتابخانه guzzle برای فرخوانی وب سرویس ها
     * @var Client
     */
    private $restCall;

    /**
     * آدرس ساخته شده توسط payping برای هدایت کاربر به داشبورد
     * @var string $payUrl
     */
    private $registerUrl;

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
     * بررسی وجود یک کاربر در payping بر اساس ایمیل کاربر
     * @param $email
     * @return bool
     * @throws PayPingException
     */
    public function checkEmail($email)
    {
        try {
            $result = $this->restCall->get(self::BASE_URL . 'v1/client/EmailExist', ['query' => ['Email' => $email]]);
            $result = json_decode($result->getBody()->getContents(), false);
            return boolval($result->exist);
        } catch (RequestException $re) {
            throw new PayPingException($re->getResponse()->getBody()->getContents(), $re->getResponse()->getStatusCode(), $re->getPrevious());
        } catch (\Exception $exception) {
            throw new PayPingException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

    /**
     * ثبت نام کاربر در payping
     * @param $callback
     * @param array $params
     * @return string
     * @throws PayPingException
     */
    public function registerUser($callback, array $params)
    {
        if (!isset($params['Email'])) {
            throw new PayPingException("please set email in params this required", 0);
        }

        $params['ReturnUrl'] = $callback;

        try {
            $result = $this->restCall->post(self::BASE_URL . 'v1/client/ClientRegisterInit', ['body' => json_encode($params)]);
            $result = json_decode($result->getBody()->getContents(), false);
            if (!isset($result->id) || empty($result->id))
                throw new PayPingException("server error ", 500);
            $this->registerUrl = self::BASE_URL . 'Client/ClientRegister?registerId=' . $result->id;
            return $result->id;
        } catch (RequestException $re) {
            throw new PayPingException($re->getResponse()->getBody()->getContents(), $re->getResponse()->getStatusCode(), $re->getPrevious());
        } catch (\Exception $exception) {
            throw new PayPingException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }


    /**
     * @return string
     */
    public function getRegisterUrl()
    {
        return $this->registerUrl;
    }

}