<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Asm\MarkdownContentBundle\DependencyInjection\Compiler\ParserManagerCompilerPass;
use Asm\MarkdownContentBundle\DependencyInjection\Compiler\DynamicRoutingCompilerPass;
use Asm\MarkdownContentBundle\DependencyInjection\Compiler\ContentManagerCompilerPass;
use Asm\MarkdownContentBundle\DependencyInjection\Compiler\HookManagerCompilerPass;

/**
 * Class AsmMarkdownContentBundle
 *
 * @package Asm\MarkdownContentBundle
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\HttpKernel\Bundle\Bundle
 * @uses Symfony\Component\DependencyInjection\ContainerBuilder
 * @uses Asm\MarkdownContentBundle\DependencyInjection\Compiler\ParserManagerCompilerPass
 * @uses Asm\MarkdownContentBundle\DependencyInjection\Compiler\DynamicRoutingCompilerPass
 * @uses Asm\MarkdownContentBundle\DependencyInjection\Compiler\ContentManagerCompilerPass
 * @uses Asm\MarkdownContentBundle\DependencyInjection\Compiler\HookManagerCompilerPass
 */
class AsmMarkdownContentBundle extends Bundle
{

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DynamicRoutingCompilerPass());
        $container->addCompilerPass(new ParserManagerCompilerPass());
        $container->addCompilerPass(new ContentManagerCompilerPass());
        $container->addCompilerPass(new HookManagerCompilerPass());
    }
}
