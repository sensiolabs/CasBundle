<?php

namespace Bundle\Sensio\CasBundle\Service\Request;

use Bundle\Sensio\CasBundle\Service\Request\RequestInterface;
use Bundle\Sensio\CasBundle\Service\Request\Request;
use Bundle\Sensio\CasBundle\Service\Response\ResponseInterface;

class FileRequest extends Request implements RequestInterface
{
    public function send(ResponseInterface $response)
    {
        $this->response = $response;
        $this->response->setBody(file_get_contents($this->uri));

        return $this;
    }
}