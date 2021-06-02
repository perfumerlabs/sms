<?php

namespace Sms\Service;

abstract class AbstractProvider
{
    /**
     * @param string|array $phones
     * @param string $text
     * @return bool
     */
    abstract public function send($phones, $text, $type): bool;
}