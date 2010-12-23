<?php

namespace Bundle\Sensio\CasBundle\Security;

use Symfony\Component\Security\Authentication\Token\Token;
use Symfony\Component\Security\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Authentication\Provider\PreAuthenticatedAuthenticationProvider;
use Symfony\Component\Security\Authentication\Provider\AuthenticationProviderInterface;

class CasAuthenticationProvider extends PreAuthenticatedAuthenticationProvider implements AuthenticationProviderInterface
{
}