<?php

namespace Sensio\CasBundle\Service\Response;

abstract class Response
{
    protected
        $headers = array(),
        $success,
        $username,
        $attributes = array(),
        $failureMessage;

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function addHeader($header)
    {
        $this->headers[] = (string) $header;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getFailureMessage()
    {
        return $this->failureMessage;
    }
}