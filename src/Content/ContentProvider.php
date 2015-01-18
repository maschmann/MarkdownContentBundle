<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/** namespace Asm\MarkdownContentBundle\Content */
namespace Asm\MarkdownContentBundle\Content;


use Asm\MarkdownContentBundle\Parser\ParserManagerInterface;
use Asm\MarkdownContentBundle\Content\ContentManagerInterface;
use Asm\MarkdownContentBundle\Event\PreParseHookEvent;
use Asm\MarkdownContentBundle\Event\PostParseHookEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


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
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var string
     */
    private $loader;

    /**
     * @var string
     */
    private $parser;


    /**
     * default constructor
     *
     * @param ContentManagerInterface  $contentManager
     * @param ParserManagerInterface   $parserManager
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ContentManagerInterface $contentManager,
        ParserManagerInterface $parserManager,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->contentManager  = $contentManager;
        $this->parserManager   = $parserManager;
        $this->eventDispatcher = $eventDispatcher;
    }


    /**
     * @param string $uri
     * @return array
     */
    public function getContent($uri)
    {
        $content = $this->loadContent($uri);
        // run pre hooks
        $event = $this->eventDispatcher
            ->dispatch(
                'asm_markdown_content.hook.pre_parse',
                new PreParseHookEvent($content)
            );

        $content = $event->getContent();

        // convert content
        if (is_array($content['content'])) {
            $content['content'] = implode('', $content['content']);
        }
        $content['content'] = $this->parserManager
            ->getParser($this->parser)
            ->parseText($content['content']);

        // run post hooks
        $event = $this->eventDispatcher
            ->dispatch(
                'asm_markdown_content.hook.post_parse',
                new PostParseHookEvent($content)
            );

        return $event->getContent();
    }

    /**
     * set loader type for content
     *
     * @param string $loader
     * @return $this
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;

        return $this;
    }

    /**
     * set name of parser to use
     *
     * @param string $parser
     * @return $this
     */
    public function setParser($parser)
    {
        $this->parser = $parser;

        return $this;
    }

    /**
     * load content from provider
     *
     * @param string $uri
     * @return array
     */
    private function loadContent($uri)
    {
        $content = array(
            'data'    => array(),
            'content' => '',
        );
        $data = $this->contentManager->getLoader($this->loader)->load($uri);

        if (empty($data)) {
            // page not found 404
        } else {
            $content['content'] = $data;
        }

        return $content;
    }
}
