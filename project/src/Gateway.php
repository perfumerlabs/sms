<?php

namespace Project;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addModule('sms', 'SMS_HOST', null, 'http');
        $this->addModule('sms', 'sms',      null, 'cli');
    }
}
