<?php
/**
 * @namespace
 */
namespace Asm\MarkdownContentBundle\Content;

/**
 * @author marc aschmann <marc.aschmann@internetstores.de>
 * @package Asm\MarkdownContentBundle\Content
 */
class ContentManager implements ContentManagerInterface
{

    /**
     * array of managed loader instances
     *
     * @var array
     */
    private $loaders;

    /**
     * default constructor
     */
    public function __construct()
    {
        $this->loaders = array();
    }

    /**
     * set loader
     *
     * @param  ContentLoaderInterface $loader
     * @param  string                 $alias
     * @return mixed
     */
    public function addLoader(ContentLoaderInterface $loader, $alias)
    {
        $this->loaders[$alias] = $loader;

        return $this;
    }

    /**
     * get instance of prepared loaders
     *
     * @param $alias
     * @return mixed
     */
    public function getLoader($alias)
    {
        if (isset($this->loaders[$alias])) {
            return $this->loaders[$alias];
        } else {
            return false;
        }
    }

}
