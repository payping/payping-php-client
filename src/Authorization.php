<?php


namespace PayPing;


use GuzzleHttp\Client;

class Authorization
{

    const  BASE_URL = "https://oauth.payping.ir/";

    protected $client_id = "";
    protected $client_secret = "";

    /**
     * کد یکتای ساخته شده به ازای هر کار در ابتدای  کار
     * @var string $codeVerified
     */
    private $codeVerified;


    /**
     * ادرس برگشتی برای دریافت توکن
     * @var string $callback
     */
    private $callback;

    /**
     * کتابخانه guzzle برای فرخوانی وب سرویس ها
     * @var Client
     */
    private $restCall;


    /**
     * Authorization constructor.
     * @param $client_id
     * @param $client_secret
     * @param null $callback
     * @param null $codeVerified
     */
    public function __construct($client_id, $client_secret, $callback = null, $codeVerified = null)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->restCall = new Client([
            'base_uri' => self::BASE_URL
        ]);

        if ($codeVerified)
            $this->codeVerified = $codeVerified;

        if ($callback)
            $this->callback = $callback;
    }

    /**
     * @param string $codeVerified
     */
    public function setCodeVerified($codeVerified)
    {
        $this->codeVerified = $codeVerified;
    }

    /**
     * @return string
     */
    public function getCodeVerified()
    {
        return $this->codeVerified;
    }

    /**
     * @param string $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param Client $restCall
     */
    public function setRestCall($restCall)
    {
        $this->restCall = $restCall;
    }

    /**
     * دریافت لینک برای احراز هویت توسط payping
     * @param array $scopes
     * @param null $state
     * @return string
     * @throws PayPingException
     */
    public function getAuthLink(array $scopes = [Scopes::OPENID], $state = NULL)
    {

        if (empty($this->codeVerified))
            throw new PayPingException("empty codeVerified please call setCodeVerified first");
        if (empty($this->callback))
            throw new PayPingException("empty callback please call setCallback first");

        if (!in_array(Scopes::OPENID, $scopes))
            $scopes[] = Scopes::OPENID;

        $params = [
            'scope' => implode(' ', $scopes),
            'response_type' => 'code',
            'client_id' => $this->client_id,
            'code_challenge' => generateCodeChallenge($this->getCodeVerified()),
            'code_challenge_method' => 'S256',
            'redirect_uri' => $this->getCallback(),
        ];

        if (!empty($state)) $params['state'] = $state;

        return urldecode(self::BASE_URL . "connect/authorize?" . http_build_query($params, null, '&'));

    }

    /**
     * دریافت access_token از payping بوسیله کد احراز شده
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws PayPingException
     */
    public function getAccessToken()
    {
        if (empty($this->codeVerified))
            throw new PayPingException("empty codeVerified please call setCodeVerified first");
        if (empty($this->callback))
            throw new PayPingException("empty callback please call setCallback first");

        if (!isset($_GET['code']) || empty($_GET['code']))
            throw new PayPingException("invalid request", '401');
        $token = $_GET['code'];

        $params = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code_verifier' => $this->getCodeVerified(),
            'code' => $token,
            'redirect_uri' => $this->getCallback()
        ];
        try {
            $result = $this->restCall->post('connect/token', ['form_params' => $params]);
            $result = json_decode($result->getBody()->getContents(), false);
        } catch (\Exception $exception) {
            throw new PayPingException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return $result;

    }
}
