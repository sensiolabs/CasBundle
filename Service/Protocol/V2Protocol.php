<?php

namespace Sensio\CasBundle\Service\Protocol;

use Sensio\CasBundle\Service\Protocol\Protocol;
use Sensio\CasBundle\Service\Protocol\ProtocolInterface;

class V2Protocol extends Protocol implements ProtocolInterface
{
    public function getValidationUri($service, $ticket)
    {
        return $this->buildUri('serviceValidate', array(
            'service' => $this->cleanUri($service),
            'ticket' => $ticket,
        ));
    }
}