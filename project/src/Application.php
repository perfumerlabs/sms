<?php

namespace Project;

use Perfumer\Package\Framework\Module\ConsoleModule;
use Sms\Module\CommandModule;
use Sms\Module\ControllerModule;
use Perfumer\Package\Framework\Module\HttpModule;

class Application extends \Perfumer\Framework\Application\Application
{
    protected function configure(): void
    {
        $this->addDefinitions(__DIR__ . '/../vendor/perfumer/framework/src/Package/Framework/Resource/config/services.php');
        $this->addResources(__DIR__ . '/../vendor/perfumer/framework/src/Package/Framework/Resource/config/resources.php');

        $this->addDefinitions(__DIR__ . '/../src/Resource/config/services_shared.php');
        $this->addDefinitions(__DIR__ . '/../src/Resource/config/services_http.php', 'http');
        $this->addDefinitions(__DIR__ . '/../src/Resource/config/services_cli.php',  'cli');
        $this->addResources(__DIR__ . '/../src/Resource/config/resources_shared.php');

        $this->addResources(__DIR__ . '/../env.php');

        $this->addModule(new HttpModule(),       'http');
        $this->addModule(new ControllerModule(), 'http');
        $this->addModule(new ConsoleModule(),    'cli');
        $this->addModule(new CommandModule(),    'cli');
    }

    protected function before(): void
    {
        date_default_timezone_set('UTC');

        define('TMP_DIR', __DIR__ . '/../tmp/');
    }

    protected function after(): void
    {
        $this->container->get('propel.service_container');
    }
}
