<?php

namespace Asm\MarkdownContentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('asm_markdown_content');

        $rootNode
            ->children()
                ->scalarNode('content_directory')
                    ->info('Place where the content files are located.')
                    ->defaultValue('app/Resources/markdown')
                ->end()
                ->scalarNode('route_prefix')
                    ->info('Prefix for the content routes, default is "content".')
                    ->defaultValue('content')
                ->end()
                ->scalarNode('markdown_provider')
                    ->defaultValue('evil')
                    ->info('Provider which to call for mardown to HTML conversion.')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
