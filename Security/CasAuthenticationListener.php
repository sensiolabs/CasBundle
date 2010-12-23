<?php

namespace Bundle\Sensio\CasBundle\Security;

use Symfony\Component\Security\SecurityContext;
use Symfony\Component\Security\Authentication\AuthenticationManagerInterface;
use Symfony\Component\HttpKernel\Security\Firewall\PreAuthenticatedListener;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Exception\BadCredentialsException;
use Symfony\Component\HttpKernel\Security\Firewall\ListenerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Bundle\Sensio\CasBundle\Service\Cas;

class CasAuthenticationListener extends PreAuthenticatedListener implements ListenerInterface
{
    protected $cas;

    public function __construct(SecurityContext $securityContext, AuthenticationManagerInterface $authenticationManager, Cas $cas, LoggerInterface $logger = null)
    {
        parent::__construct($securityContext, $authenticationManager, $logger);
        $this->cas = $cas;
    }

    public function handle(Event $event)
    {
        if($this->cas->isValidationRequest($event->get('request'))) {
            parent::handle($event);
        }
    }

    protected function getPreAuthenticatedData(Request $request)
    {
        $validation = $this->cas->getValidation($request);

        if($validation->isSuccess()) {
            return array($validation->getUsername(), $validation->getAttributes());
        }

        throw new BadCredentialsException('CAS validation failure : '.$validation->getFailureMessage());
    }
}
