<?php

namespace Sensio\CasBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\Token;

class CasAuthenticationToken extends Token
{
    protected $casAttributes;

    public function __construct($user, array $attributes = array(), $providerKey = null, array $roles = array())
    {
        parent::__construct($roles);

        $this->setUser($user);
        $this->credentials = null;
        $this->providerKey = $providerKey;
        $this->casAttributes = $attributes;

        parent::setAuthenticated(true);
    }

    public function getCasAttributes()
    {
        return $this->attributes;
    }
}