<?php

namespace Sms\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Sms\Helper\Phone;

class SmscRuProvider extends AbstractProvider
{
    /**
     * @var string
     */
    protected string $sender;

    /**
     * @var string
     */
    protected string $username;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @var string
     */
    protected string $dummy;

    /**
     * @param string $sender
     * @param string $username
     * @param string $password
     * @param string $dummy
     */
    public function __construct($sender, $username, $password, $dummy)
    {
        $this->sender = (string) $sender;
        $this->username = (string) $username;
        $this->password = (string) $password;
        $this->dummy = (string) $dummy;
    }

    /**
     * @param string|array $phones
     * @param string $message
     * @return bool
     */
    public function send($phones, $message, $type): bool
    {
        if (!is_array($phones)) {
            $phones = [$phones];
        }

        if (count($phones) == 0) {
            return false;
        }

        $phone_string = implode(',', $phones);

        if ($this->dummy === 'true') {
            error_log("Dummy sent \"$message\" to $phone_string");

            return true;
        }

        if($type === 'sms') {
            $url = 'https://smsc.ru/sys/send.php?fmt=3&charset=utf-8&sender=%s&login=%s&psw=%s&phones=%s&mes=%s';
            $url = sprintf($url, $this->sender, $this->username, $this->password, urlencode($phone_string), urlencode($message));
        }else{
            $url = 'https://smsc.kz/sys/send.php?login=%s&psw=%s&phones=%s&mes=%s&call=1';
            $url = sprintf($url, $this->username, $this->password, urlencode($phone_string), urlencode($message));
        }

        try {
            $options = [
                'connect_timeout' => 15,
                'read_timeout'    => 15,
                'timeout'         => 15,
            ];

            $client = new Client();
            $response = $client->post($url, $options);

            $result = json_decode($response->getBody(), true);

            $sent = !isset($result['error_code']);

            if ($sent) {
                error_log("Sent \"$message\" to $phone_string");
            } else {
                $error = $result['error'] ?? '';
                $error_code = $result['error_code'] ?? '';

                error_log("Error sending \"$message\" to $phone_string: error code $error_code, {$error}");
            }

            return $sent;
        } catch (ConnectException $e) {
            error_log("Timeout \"$message\" to $phone_string");

            return false;
        } catch (\Throwable $e) {
            error_log("Error sending \"$message\" to $phone_string: {$e->getMessage()}");

            return false;
        }
    }
}