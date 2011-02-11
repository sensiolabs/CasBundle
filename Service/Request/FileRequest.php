<?php

namespace Sensio\CasBundle\Service\Request;

use Sensio\CasBundle\Service\Request\RequestInterface;
use Sensio\CasBundle\Service\Request\Request;
use Sensio\CasBundle\Service\Response\ResponseInterface;

class FileRequest extends Request implements RequestInterface
{
    public function send(ResponseInterface $response)
    {
        $this->response = $response;
        $this->response->setBody(file_get_contents($this->uri));

        return $this;
    }
}