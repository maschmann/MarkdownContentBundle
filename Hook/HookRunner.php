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

use Asm\MardownContentBundle\Hook\HookManagerInterface;

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
    private $content = '';

    /**
     * @var array
     */
    private $data = array();

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
        $this->content = $content['content'];
        $this->data    = $content['data'];

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
        return $this;
    }


    /**
     * @return $this
     */
    public function runContentHooks()
    {
        return $this;
    }


    /**
     * @return $this
     */
    public function runPostHooks()
    {
        return $this;
    }
}
