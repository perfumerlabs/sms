<?php

namespace Sms\Service;

trait ValidationHelpers
{
    protected function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }

    protected function validateNotEmptyArray($var, $name)
    {
        if (!is_array($var) || count($var) == 0) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
