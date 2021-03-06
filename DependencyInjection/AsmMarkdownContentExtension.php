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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AsmMarkdownContentExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $defaults = array(
            'content_directory'  => 'app/Resources/markdown',
            'route_prefix'       => 'content',
            'markdown_provider'  => 'php-markdown',
            'content_loader'     => 'file-loader',
            'locale_url'         => false,
        );

        foreach ($defaults as $key => $value) {
            if (isset($config[$key])
                & false === is_array($config[$key])) {
                $value = $config[$key];
            }

            $container->setParameter('asm_markdown_content.' . $key, $value);
        }
    }
}
