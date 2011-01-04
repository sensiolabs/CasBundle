<?php

namespace Bundle\Sensio\CasBundle\Security;

use Symfony\Component\Security\Authentication\Token\Token;

class CasAuthenticationToken extends Token
{
    protected $casAttributes;

    public function __construct($user, array $attributes = array(), $userProviderName = null, array $roles = array())
    {
        parent::__construct($roles);

        $this->setUser($user);
        $this->credentials = null;
        $this->userProviderName = $userProviderName;
        $this->casAttributes = $attributes;

        parent::setAuthenticated(true);
    }

    public function getCasAttributes()
    {
        return $this->attributes;
    }
}