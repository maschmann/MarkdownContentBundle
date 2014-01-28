<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/** @namespace Asm\MarkdownContentBundle\DependencyInjection\Compiler */
namespace Asm\MarkdownContentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ParserManagerCompilerPass
 *
 * @package Asm\MarkdownContentBundle\DependencyInjection\Compiler
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\DependencyInjection\ContainerBuilder
 * @uses Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
 * @uses Symfony\Component\DependencyInjection\Reference
 */
class ParserManagerCompilerPass  implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('asm_markdown_content.parser_manager')) {
            return;
        }

        $definition = $container->getDefinition(
            'asm_markdown_content.parser_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'asm_markdown_content.parser'
        );
        foreach ($taggedServices as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \ErrorException('Please define an alias for ' . $id . ' service for mapping!');
            }
            $definition->addMethodCall(
                'addParser',
                array(
                    new Reference($id),
                    $attributes[0]['alias']
                )
            );
        }
    }
}
