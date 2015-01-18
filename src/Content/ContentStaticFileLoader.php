<?php
/*
 * This file is part of the MarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asm\MarkdownContentBundle\Content;

/**
 * Class ContentStaticFileLoader
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 */
final class ContentStaticFileLoader implements ContentLoaderInterface
{
    /**
     * @param  string     $uri
     * @return mixed|void
     */
    public function load($uri)
    {
        if (is_a($uri, 'SplFileInfo')) {
            return $uri->getContents();
        } else {
            throw new \InvalidArgumentException('Given file resource is not a SplFileInfo object');
        }
    }
}
