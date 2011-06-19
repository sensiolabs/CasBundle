<?php

namespace Sensio\CasBundle\Service\Response;

interface ResponseInterface
{
    function isSuccess();
    function getUsername();
    function getAttributes();
}