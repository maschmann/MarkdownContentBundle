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

use Asm\TranslationLoaderBundle\Hook\HookInterface;

/**
 * Interface HookDataInterface
 *
 * @package Asm\MarkdownContentBundle\Hook
 * @author marc aschmann <maschmann@gmail.com>
 */
interface HookDataInterface extends HookInterface
{
    /**
     * main method of hook, changes content
     *
     * @param string $content
     * @return string
     */
    public function parseContent($content);
}
