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
     * @return mixed
     */
    public function load();


    /**
     * set resource for loader
     *
     * @param $resource
     * @return mixed
     */
    public function setResource($resource);
}
