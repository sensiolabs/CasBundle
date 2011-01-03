<?php

namespace Bundle\Sensio\CasBundle\Service\Request;

use Bundle\Sensio\CasBundle\Service\Request\RequestInterface;
use Bundle\Sensio\CasBundle\Service\Request\Request;
use Bundle\Sensio\CasBundle\Service\Response\ResponseInterface;

class HttpRequest extends Request implements RequestInterface
{
    public function send(ResponseInterface $response)
    {
        $request = new \HttpRequest($this->uri);
        $request->setHeaders($this->headers);
        $request->setCookies($this->cookies);
        $request->setSslOptions(array('CERT' => $this->certFile));
        $request->send();

        $this->response = $response;
        $this->response->setHeaders($request->getResponseHeader());
        $this->response->setBody($request->getResponseBody());

        return $this;
    }
}