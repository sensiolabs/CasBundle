<?php

namespace Bundle\Sensio\CasBundle\Service\Protocole;

use Bundle\Sensio\CasBundle\Service\Protocole\Protocole;
use Bundle\Sensio\CasBundle\Service\Protocole\ProtocoleInterface;

class V2Protocole extends Protocole implements ProtocoleInterface
{
    public function getValidationUri($service, $ticket)
    {
        return $this->buildUri('serviceValidate', array(
            'service' => $this->cleanUri($service),
            'ticket' => $ticket,
        ));
    }
}