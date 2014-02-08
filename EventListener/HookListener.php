<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\EventListener;

use Asm\MarkdownContentBundle\Event\PreParseHookEvent;
use Asm\MarkdownContentBundle\Event\PostParseHookEvent;
use Asm\MarkdownContentBundle\Hook\HookManagerInterface;

/**
 * Class HookListener
 *
 * @package Asm\MarkdownContentBundle\EventListener
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Asm\MarkdownContentBundle\Event\PreParseHookEvent
 * @uses Asm\MarkdownContentBundle\Event\PostParseHookEvent
 * @uses Asm\MarkdownContentBundle\Hook\HookManagerInterface
 */
class HookListener
{

    /**
     * @var HookManagerInterface $hookManager
     */
    private $hookManager;

    /**
     * @param HookManagerInterface $hookManager
     */
    public function __construct(HookManagerInterface $hookManager)
    {
        $this->hookManager = $hookManager;
    }

    /**
     * @param PreParseHookEvent $event
     * @return PreParseHookEvent
     */
    public function onPreParseHook(PreParseHookEvent $event)
    {
        $event->setContent(
            $this->runHooks(
                $this->hookManager->getPreHooks(),
                $event->getContent()
            )
        );

        return $event;
    }

    /**
     * @param PostParseHookEvent $event
     * @return PostParseHookEvent
     */
    public function onPostParseHook(PostParseHookEvent $event)
    {
        $event->setContent(
            $this->runHooks(
                $this->hookManager->getPostHooks(),
                $event->getContent()
            )
        );

        return $event;
    }


    /**
     * iterate hooks, call worker
     *
     * @param array $hooks
     * @param array $content
     * @return array
     */
    private function runHooks($hooks, array $content)
    {
        foreach ($hooks as $hook)
        {
            $content = $hook->workContent($content);
        }

        return $content;
    }
}
