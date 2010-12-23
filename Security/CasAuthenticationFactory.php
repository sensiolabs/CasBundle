<?php

namespace Bundle\Sensio\CasBundle\Security;

use  Symfony\Bundle\FrameworkBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CasAuthenticationFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $providerIds, $defaultEntryPoint)
    {
        $provider = 'security.authentication.provider.cas.'.$id;
        $container
            ->register($provider, '%security.authentication.provider.cas.class%')
            ->setArguments(array(new Reference($userProvider), new Reference('security.account_checker')))
        ;

        // listener
        $listenerId = 'security.authentication.listener.cas.'.$id;
        $listener = $container->setDefinition($listenerId, clone $container->getDefinition('security.authentication.listener.cas'));
        $arguments = $listener->getArguments();
        $arguments[1] = new Reference($provider);
        $listener->setArguments($arguments);

        return array($provider, $listenerId, 'security.authentication.cas_entry_point');
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'cas';
    }
}
