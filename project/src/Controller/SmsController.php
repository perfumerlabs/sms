<?php

namespace Sms\Controller;

use Sms\Service\AbstractProvider;

class SmsController extends LayoutController
{
    public function post()
    {
        $phones = $this->f('phones');
        $message = (string) $this->f('message');

        $this->validateNotEmpty($message, 'message');

        /** @var AbstractProvider $provider */
        $provider = $this->s('provider.smscru');
        $sent = $provider->send($phones, $message);

        $this->setStatus($sent);
    }

    private function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
