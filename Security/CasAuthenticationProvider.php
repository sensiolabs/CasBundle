<?php

namespace Bundle\Sensio\CasBundle\Security;

use Symfony\Component\Security\User\UserProviderInterface;
use Symfony\Component\Security\User\AccountCheckerInterface;
use Symfony\Component\Security\Authentication\Token\Token;
use Symfony\Component\Security\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Authentication\Provider\PreAuthenticatedAuthenticationProvider;
use Symfony\Component\Security\Authentication\Provider\AuthenticationProviderInterface;
use Bundle\Sensio\CasBundle\Security\CasAuthenticationToken;

class CasAuthenticationProvider implements AuthenticationProviderInterface
{
    protected $userProvider;
    protected $accountChecker;

    public function __construct(UserProviderInterface $userProvider, AccountCheckerInterface $accountChecker)
    {
        $this->userProvider = $userProvider;
        $this->accountChecker = $accountChecker;
    }

     public function authenticate(TokenInterface $token)
     {
         if (!$this->supports($token)) {
             return null;
         }

        if (!$user = $token->getUser()) {
            throw new BadCredentialsException('No pre-authenticated principal found in request.');
        }

        $user = $this->userProvider->loadUserByUsername($user);

        //$this->accountChecker->checkPostAuth($user);

        return $token;
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof CasAuthenticationToken;
    }
}