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


use Asm\MarkdownContentBundle\Hook\HookRunner;
use Asm\MarkdownContentBundle\Parser\ParserManagerInterface;

class ContentManager
{

    private $contentLoader;
    private $parserManager;
    private $hookRunner;

    public function __construct(ContentLoader $contentLoader,
        ParserManagerInterface $parserManager,
        HookRunner $hookRunner
    ) {
        $this->contentLoader = $contentLoader;
        $this->parserManager = $parserManager;
        $this->hookRunner    = $hookRunner;
    }
}
