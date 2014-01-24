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
use Symfony\Component\Yaml\Yaml;

class DynamicRoutingCompilerPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $routerResource = $container->getParameterBag()->resolveValue(
            $container->getParameter('router.resource')
        );

        if (!$routerResource) {
            return;
        }

        $file = $container->getParameter('kernel.cache_dir') . '/asm_markdown_content/routing.yml';

        if (!is_dir($dir = dirname($file))) {
            mkdir($dir, 0777, true);
        }

        file_put_contents(
            $file,
            Yaml::dump(
                array(
                    '_assetic' => array(
                        'resource' => '.',
                        'type'     => 'markdown.content'
                    ),
                    '_app' => array(
                        'resource' => $container->getParameter('router.resource')
                    ),
                )
            )
        );

        $container->setParameter('router.resource', $file);
    }
}
