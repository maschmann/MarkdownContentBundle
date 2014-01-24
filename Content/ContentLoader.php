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


class ContentLoader
{

    private $directory;

    private $pathDepth;

    public function __construct($directory, $pathDepth)
    {
        $this->directory = $directory;
        $this->pathDepth = $pathDepth;
    }
}
