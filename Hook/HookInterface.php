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

/**
 * Interface HookInterface
 *
 * @package Asm\MarkdownContentBundle\Hook
 * @author marc aschmann <maschmann@gmail.com>
 */
interface HookInterface
{
    /**
     * defines type of hook: pre, post or data
     *
     * @return string
     */
    public function getType();
}
