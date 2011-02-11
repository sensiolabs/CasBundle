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

        if($this->certFile) {
            $options = array(
                CURLOPT_SSL_VERIFYHOST => 1,
                CURLOPT_SSL_VERIFYPEER => 1,
                CURLOPT_CAINFO => $this->certFile,
            );
        } else {
            $options = array(
                CURLOPT_SSL_VERIFYHOST => 1,
                CURLOPT_SSL_VERIFYPEER => 0,
            );
        }

        $options = array_merge($options, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADERFUNCTION => array($this->response, 'setHeaders'),
            CURLOPT_COOKIE => implode(';', $this->cookies),
            CURLOPT_HTTPHEADER => $this->headers,
        ));

        curl_setopt_array($request, $options);
        $this->response->setBody(curl_exec($request));
        curl_close($request);

        return $this;
    }
}