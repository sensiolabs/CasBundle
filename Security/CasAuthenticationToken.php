<?php

namespace Bundle\Sensio\CasBundle\Security;

use Symfony\Component\Security\Authentication\Token\Token;

class CasAuthenticationToken extends Token
{
    protected $attributes;

    public function __construct($user, array $attributes = array(), $userProviderName = null, array $roles = array())
    {
        parent::__construct($roles);

        $this->setUser($user);
        $this->credentials = null;
        $this->userProviderName = $userProviderName;
        $this->attributes = $attributes;

        parent::setAuthenticated(true);
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}