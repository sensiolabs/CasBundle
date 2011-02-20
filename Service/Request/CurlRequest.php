<?php

namespace Sensio\CasBundle\Service\Request;

use Sensio\CasBundle\Service\Request\RequestInterface;
use Sensio\CasBundle\Service\Request\Request;
use Sensio\CasBundle\Service\Response\ResponseInterface;

class CurlRequest extends Request implements RequestInterface
{
    public function send(ResponseInterface $response)
    {
        $this->response = $response;
        $request = curl_init($this->uri);

        $options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADERFUNCTION => array($this, 'addResponseHeader'),
            CURLOPT_HTTPHEADER => $this->headers,
        );

        if (count($this->cookies)) {
            $options[CURLOPT_COOKIE] = implode(';', $this->cookies);
        }

        if($this->certFile) {
            $sslOptions = array(
                CURLOPT_SSL_VERIFYHOST => 1,
                CURLOPT_SSL_VERIFYPEER => 1,
                CURLOPT_CAINFO => $this->certFile,
            );
        } else {
            $sslOptions = array(
                CURLOPT_SSL_VERIFYPEER => 0,
            );
        }

        curl_setopt_array($request, $options);
        curl_setopt_array($request, $sslOptions);

        $this->response->setBody(curl_exec($request));
        curl_close($request);

        return $this;
    }

    public function addResponseHeader($request, $header)
    {
        $this->response->addHeader($header);
        return strlen($header);
    }
}