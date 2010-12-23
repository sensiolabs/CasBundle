<?php

namespace Bundle\Sensio\CasBundle\Service\Protocole;

interface ProtocoleInterface
{
    public function getLoginUri($service);
    public function getLogoutUri($service);
    public function getValidationUri($service, $ticket);
}