<?php

namespace Sensio\CasBundle\Service\Response;

interface ResponseInterface
{
    public function isSuccess();
    public function getUsername();
    public function getAttributes();
}