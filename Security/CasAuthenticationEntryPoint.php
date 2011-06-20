<?php

namespace Sensio\CasBundle\Security;

use Sensio\CasBundle\Service\Cas;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\CasBundle\Service\Client;

class CasAuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    protected $cas;

    public function __construct(Cas $cas)
    {
        $this->cas = $cas;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return $this->cas->getLoginResponse($request);
    }
}