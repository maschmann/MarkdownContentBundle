<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Hook;

use Asm\MarkdownContentBundle\Hook\HookManagerInterface;

/**
 * Class HookRunner
 *
 * @package Asm\MarkdownContentBundle\Hook
 * @author marc aschmann <maschmann@gmail.com>
 */
class HookRunner
{
    /**
     * @var HookManagerInterface $hookManager
     */
    private $hookManager;

    /**
     * @var string
     */
    private $content = array();

    /**
     * @param HookManagerInterface $hookManager
     */
    public function __construct(HookManagerInterface $hookManager)
    {
        $this->hookManager = $hookManager;
    }


    /**
     * set loader loaded content
     *
     * @param array $content
     * @return $this
     */
    public function setContent(array $content)
    {
        $this->content = $content;

        return $this;
    }


    /**
     * finished content
     *
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @return $this
     */
    public function runPreHooks()
    {
        $this->runHooks($this->hookManager->getPreHooks());

        return $this;
    }


    /**
     * @return $this
     */
    public function runPostHooks()
    {
        $this->runHooks($this->hookManager->getPostHooks());

        return $this;
    }


    /**
     * iterate hooks, call worker
     *
     * @param array $hooks
     */
    private function runHooks($hooks)
    {
        foreach ($hooks as $hook)
        {
           $this->content = $hook->workContent($this->content);
        }
    }
}
