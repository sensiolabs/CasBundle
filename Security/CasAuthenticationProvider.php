<?php

namespace Sensio\CasBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Token;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Provider\PreAuthenticatedAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Sensio\CasBundle\Security\CasAuthenticationToken;

class CasAuthenticationProvider implements AuthenticationProviderInterface
{
    protected $userProvider;
    protected $userChecker;

    public function __construct(UserProviderInterface $userProvider, UserCheckerInterface $userChecker)
    {
        $this->userProvider = $userProvider;
        $this->userChecker = $userChecker;
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
        $token->setUser($user);
        $token->setRoles($user->getRoles());

        $this->userChecker->checkPostAuth($user);

        return $token;
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof CasAuthenticationToken;
    }
}