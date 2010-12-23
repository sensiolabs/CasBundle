<?php

namespace Bundle\Sensio\CasBundle\Service\Protocole;

use Bundle\Sensio\CasBundle\Service\Protocole\Protocole;
use Bundle\Sensio\CasBundle\Service\Protocole\ProtocoleInterface;

class V1Protocole extends Protocole implements ProtocoleInterface
{
    public function getValidationUri($service, $ticket)
    {
        return $this->buildUri('validate', array(
            'service' => $this->cleanUri($service),
            'ticket' => $ticket,
        ));
    }
}