<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class ParseHookEventAbstract
 *
 * @package Asm\MarkdownContentBundle\Event
 * @author marc aschmann <maschman@gmail.com>
 * @uses Symfony\Component\EventDispatcher\Event
 */
abstract class ParseHookEventAbstract extends Event
{
    /**
     * @var array
     */
    protected $content = array();

    /**
     * @param array $content
     */
    public function __construct(array $content)
    {
        $this->setContent($content);
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param array $content
     */
    public function setContent(array $content)
    {
        $this->content = $content;
    }
}
