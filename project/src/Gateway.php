<?php

namespace Project;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addModule('sms', null,  null, 'http');
        $this->addModule('sms', 'sms', null, 'cli');
    }
}
