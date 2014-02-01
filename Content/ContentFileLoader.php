<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Content;

use Symfony\Component\Finder\Finder;

/**
 * Class ContentLoader
 *
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\Finder
 */
class ContentFileLoader implements ContentLoaderInterface
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
     * @param string $rootDir
     * @param string $directory
     * @param string $pathDepth
     */
    public function __construct($rootDir, $directory, $pathDepth)
    {
        $this->directory = $rootDir . '/../' . $directory;
        $this->pathDepth = $pathDepth;
    }


    /**
     * @param string $uri
     * @return mixed|void
     */
    public function load($uri)
    {
        return $this->getContent($uri);
    }


    /**
     * extract contents from file
     *
     * @param string $uri
     * @return string
     */
    private function getContent($uri)
    {
        $searchStructure = $this->prepare($uri);
        /** @var \Symfony\Component\Finder\Finder $finder */
        $finder = new Finder();
        //$finder->depth($this->pathDepth);
        $finder->name($searchStructure['filename']);

        foreach ($finder->in($searchStructure['path']) as $file) {
            $content = $file->getContents();
            break;
        }

        return $content;
    }


    /**
     * analyze request uri and prepare search params
     *
     * @param string $uri
     * @return array
     */
    private function prepare($uri)
    {
        $path             = '';
        $filename         = 'index.*';
        $pagePathElements = explode('/', $uri);

        if (count($pagePathElements) > 1) {
            $filename = array_pop($pagePathElements);
            $path     = '/' . implode('/', $pagePathElements);
        } else {
            $filename = $pagePathElements[0];
        }

        return array(
            'filename' => str_replace('.html', '.*', $filename),
            'path'     => $this->directory . $path,
        );
    }
}
