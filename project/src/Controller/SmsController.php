<?php

namespace Sms\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Sms\Helper\Phone;
use Sms\Model\BlacklistQuery;
use Sms\Service\AbstractProvider;

class SmsController extends LayoutController
{
    public function post()
    {
        $phones = $this->f('phones');
        $message = (string) $this->f('message');
        $force = (bool) $this->f('force');
        $type = $this->f('type', 'sms');

        if(!in_array($type, ['sms', 'call'])){
            $this->forward('error', 'badRequest', ["\"type\" parameter must be set one of ['sms', 'call']"]);
        }

        if (!is_array($phones)) {
            $phones = [$phones];
        }

        $phones = array_map(function ($phone) {
            return Phone::sanitize($phone);
        }, $phones);

        $phones = array_filter($phones);

        $this->validateNotEmptyArray($phones, 'phones');
        $this->validateNotEmpty($message, 'message');

        if (!$force) {
            $blacklisted_phones = BlacklistQuery::create()
                ->filterByPhone($phones, Criteria::IN)
                ->select('phone')
                ->find()
                ->getData();

            if ($blacklisted_phones) {
                $phones = array_diff($phones, $blacklisted_phones);
                error_log(implode(', ', $blacklisted_phones) . ' are blacklisted');
            }
        }

        /** @var AbstractProvider $provider */
        $provider = $this->s('provider.smscru');
        $sent = $provider->send($phones, $message, $type);

        $this->setStatus($sent);
    }
}
