<?php

namespace Sms\Module;

use Perfumer\Framework\Controller\Module;

class ControllerModule extends Module
{
    public $name = 'sms';

    public $router = 'sms.router';

    public $request = 'sms.request';

    public $components = [
        'view' => 'view.status'
    ];
}