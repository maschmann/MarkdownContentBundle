<?php
/**
 * @namespace
 */
namespace Asm\MarkdownContentBundle\Content;

/**
 * @author marc aschmann <marc.aschmann@internetstores.de>
 * @package Asm\MarkdownContentBundle\Content
 */
interface ContentLoaderInterface
{

    /**
     * load from resources
     *
     * @param  string $uri
     * @return mixed
     */
    public function load($uri);
}
