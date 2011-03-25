<?php

namespace Sensio\CasBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

class SensioCasExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        // add configuration
        $tree = $configuration->getConfigTree();
        $config = $processor->process($tree, $configs);

        foreach ($config as $key => $value) {
            $container->setParameter('sensio_cas.'.$key, $value);
        }

        // load service
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('cas.xml');
    }

    public function getAlias()
    {
        return 'sensio_cas';
    }

}
