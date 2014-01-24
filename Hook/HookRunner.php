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

    public function runPreHooks()
    {

    }

    public function runContentHooks()
    {

    }

    public function runPostHooks()
    {

    }
}
