<?php

namespace Bundle\Sensio\CasBundle\Service\Request;

use Bundle\Sensio\CasBundle\Service\Response\ResponseInterface;

interface RequestInterface
{
    public function __construct($uri);
    public function setHeaders(array $headers = array());
    public function setCookies(array $cookies = array());
    public function setCertFile($file = null);
    public function send(ResponseInterface $response);
    public function getResponse();
}