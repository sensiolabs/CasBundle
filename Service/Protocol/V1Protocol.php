<?php

namespace Sensio\CasBundle\Service\Protocol;

use Sensio\CasBundle\Service\Protocol\Protocol;
use Sensio\CasBundle\Service\Protocol\ProtocolInterface;

class V1Protocol extends Protocol implements ProtocolInterface
{
    public function getValidationUri($service, $ticket)
    {
        return $this->buildUri('validate', array(
            'service' => $this->cleanUri($service),
            'ticket' => $ticket,
        ));
    }
}