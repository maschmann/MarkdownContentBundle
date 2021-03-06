<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 * @uses Symfony\Component\Config\Definition\Builder\TreeBuilder
 * @uses Symfony\Component\Config\Definition\ConfigurationInterface
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
                ->scalarNode('content_loader')
                    ->defaultValue('file-loader')
                    ->info('How the content is provided.')
                ->end()
                ->scalarNode('route_prefix')
                    ->info('Prefix for the content routes, default is "content".')
                    ->defaultValue('content')
                ->end()
                ->scalarNode('markdown_provider')
                    ->defaultValue('php-markdown')
                    ->info('Provider which to call for mardown to HTML conversion.')
                ->end()
                ->booleanNode('locale_url')
                    ->defaultValue(false)
                    ->info('Enable useage of locale in URLs.')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
