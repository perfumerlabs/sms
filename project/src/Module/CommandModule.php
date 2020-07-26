<?php

namespace Sms\Module;

use Perfumer\Framework\Controller\Module;

class CommandModule extends Module
{
    public $name = 'sms';

    public $router = 'router.console';

    public $request = 'sms.request';
}