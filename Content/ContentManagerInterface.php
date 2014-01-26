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

use Asm\MarkdownContentBundle\Content\ContentLoaderInterface;

/**
 * Interface ContentManagerInterface
 *
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Asm\MarkdownContentBundle\Content\ContentInterface
 */
interface ContentManagerInterface
{

    /**
     * set parser
     *
     * @param ContentLoaderInterface $loader
     * @param string $alias
     * @return mixed
     */
    public function addLoader(ContentLoaderInterface $loader, $alias);

    /**
     * get instance of configured parser
     *
     * @param $alias
     * @return mixed
     */
    public function getLoader($alias);

}
