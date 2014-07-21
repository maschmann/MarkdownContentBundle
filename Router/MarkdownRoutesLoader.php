<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/** @namespace Asm\MarkdownContentBundle\Router */
namespace Asm\MarkdownContentBundle\Router;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class MarkdownRoutesLoader
 *
 * @package Asm\MarkdownContentBundle\Router
 * @author marc aschmann <maschmann@gmail.com>
 */
class MarkdownRoutesLoader implements LoaderInterface
{
    /**
     * @var boolean
     *
     * Route is loaded
     */
    private $loaded = false;

    /**
     * @var string
     */
    private $routePrefix;

    /**
     * @param string $routePrefix
     */
    public function __construct($routePrefix = '')
    {
        $this->routePrefix = $routePrefix;
    }

    /**
     * Loads a resource.
     *
     * @param  mixed             $resource The resource
     * @param  string            $type     The resource type
     * @throws \RuntimeException Loader is added twice
     * @return RouteCollection
     */
    public function load($resource, $type = null)
    {
        if ($this->loaded) {
            throw new \RuntimeException('Do not add this loader twice');
        }

        /** @var \Symfony\Component\Routing\RouteCollection $routes */
        $routes = new RouteCollection();

        // prepare a new route
        $pattern = $this->routePrefix . '/{page}.{_format}';
        $defaults = array(
            '_controller' => 'AsmMarkdownContentBundle:Content:index',
            '_format'     => 'html'
        );
        $requirements = array(
            'page' => '.+',
        );
        $route = new Route($pattern, $defaults, $requirements);

        // add the new route to the route collection:
        $routeName = 'asm_markdown_content.content';
        $routes->add($routeName, $route);

        $this->loaded = true;

        return $routes;

    }

    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed  $resource A resource
     * @param string $type     The resource type
     *
     * @return boolean true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return 'markdown.content' === $type;
    }

    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolverInterface A LoaderResolverInterface instance
     */
    public function getResolver()
    {
    }

    /**
     * Sets the loader resolver.
     *
     * @param LoaderResolverInterface $resolver A LoaderResolverInterface instance
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}
