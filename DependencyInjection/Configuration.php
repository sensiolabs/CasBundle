<?php

namespace Sensio\CasBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
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
            ->buildTree()
        ;
    }
}
