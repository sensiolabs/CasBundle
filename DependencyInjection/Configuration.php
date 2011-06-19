<?php

namespace Sensio\CasBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        return $treeBuilder
            ->root('sensio_cas')
                ->children()
                    ->scalarNode('uri')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('version')->defaultValue(2)->end()
                    ->scalarNode('cert')->defaultFalse()->end()
                    ->scalarNode('request')->defaultValue('curl')->end()
                ->end()
            ->end()
        ;
    }
}
