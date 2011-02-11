<?php

namespace Sensio\CasBundle\Service\Request;

abstract class Request
{
    protected
        $uri,
        $headers,
        $cookies,
        $certFile,
        $response;

    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->headers = array();
        $this->cookies = array();
        $this->certFile = null;
        $this->response = null;
    }

    public function setHeaders(array $headers = array())
    {
        $this->headers = $headers;

        return $this;
    }

    public function setCookies(array $cookies = array())
    {
        $this->cookies = $cookies;

        return $this;
    }

    public function setCertFile($certFile = null)
    {
        $this->certFile = $certFile;

        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

}