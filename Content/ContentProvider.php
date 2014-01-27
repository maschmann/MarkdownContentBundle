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
use Asm\MarkdownContentBundle\Content\ContentManagerInterface;

/**
 * Class ContentManager
 *
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 */
class ContentProvider
{

    /**
     * @var \Asm\MarkdownContentBundle\Content\ContentManager
     */
    private $contentManager;

    /**
     * @var \Asm\MarkdownContentBundle\Parser\ParserManagerInterface
     */
    private $parserManager;

    /**
     * @var \Asm\MarkdownContentBundle\Hook\HookRunner
     */
    private $hookRunner;

    /**
     * @var array
     */
    private $content;

    /**
     * @var string
     */
    private $loader;

    /**
     * default constructor
     *
     * @param ContentManagerInterface $contentManager
     * @param ParserManagerInterface $parserManager
     * @param HookRunner $hookRunner
     */
    public function __construct(ContentManagerInterface $contentManager,
        ParserManagerInterface $parserManager,
        HookRunner $hookRunner
    ) {
        $this->contentManager = $contentManager;
        $this->parserManager = $parserManager;
        $this->hookRunner    = $hookRunner;

        $this->content = array(
            'data'    => array(),
            'content' => '',
        );
    }


    /**
     * @param string $uri
     * @return array
     */
    public function getContent($uri)
    {
        $this->loadContent($uri);
        $this->runHooks();

        return $this->content;
    }


    /**
     * @param string$loader
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
    }


    /**
     * @param string $uri
     */
    private function loadContent($uri)
    {
        $content = $this->contentManager->getLoader($this->loader)->load($uri);

        if (!$content) {
            // handle error -> 404 page
        } else {
            $this->content['content'] = $content;
        }
    }


    /**
     * do pre/post processing
     */
    private function runHooks()
    {
        $this->hookRunner
            ->setContent($this->content)
            ->runPreHooks()
            ->runContentHooks()
            ->runPostHooks();

        $this->content = $this->hookRunner->getContent();
    }
}
