<?php

namespace Sensio\CasBundle\Service\Protocol;

interface ProtocolInterface
{
    public function getLoginUri($service);
    public function getLogoutUri($service);
    public function getValidationUri($service, $ticket);
}