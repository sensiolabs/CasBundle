<?php

namespace Bundle\Sensio\CasBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CasExtension extends Extension
{

    public function configLoad(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('cas.xml');
        foreach(end($configs) as $key => $value) {
            $container->setParameter('cas.'.$key, $value);
        }
    }

    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return null;
    }

    public function getAlias()
    {
        return 'cas';
    }

}
