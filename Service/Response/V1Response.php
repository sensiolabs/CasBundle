<?php

namespace Sensio\CasBundle\Service\Response;

use Sensio\CasBundle\Service\Response\Response;
use Sensio\CasBundle\Service\Response\ResponseInterface;

class V1Response extends Response implements ResponseInterface
{
    public function setBody($body)
    {
        if ($body === false) {
            $this->failureMessage = 'Request failed';
            $this->success = false;

            return $this;
        }

        $data = explode("\n", str_replace("\n\n", "\n", str_replace("\r", "\n", $body)));
        $this->success = strtolower($data[0]) === 'yes';

        if ($this->success) {
            $this->username = (count($data) > 1 && $data[1]) ? $data[1] : 'Undefined';
        } else {
            $this->failureMessage = (count($data) > 1 && $data[1]) ? $data[1] : 'Unknown error';
        }

        return $this;
    }
}