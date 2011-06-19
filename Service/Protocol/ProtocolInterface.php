<?php

namespace Sensio\CasBundle\Service\Protocol;

interface ProtocolInterface
{
    function getLoginUri($service);
    function getLogoutUri($service);
    function getValidationUri($service, $ticket);
}