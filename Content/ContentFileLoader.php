<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Content;

use Symfony\Component\Finder;

/**
 * Class ContentLoader
 *
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\Finder
 */
class ContentLoader implements ContentLoaderInterface
{

    /**
     * @var string path to search in
     */
    private $directory;

    /**
     * @var integer path depth for search
     */
    private $pathDepth;


    /**
     * default constructor
     *
     * @param string $directory
     * @param string $pathDepth
     */
    public function __construct($directory, $pathDepth)
    {
        $this->directory = $directory;
        $this->pathDepth = $pathDepth;
    }


    /**
     * set resource for loader
     *
     * @param $resource
     * @return mixed
     */
    public function setResource( $resource )
    {
        // TODO: Implement setResource() method.
    }


    /**
     * @return mixed|void
     */
    public function load()
    {
        $content = '';
        return $content;
    }
}
