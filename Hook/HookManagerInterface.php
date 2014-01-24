<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Hook;

/**
 * Class HookManagerInterface
 *
 * @package Asm\MarkdownContentBundle\Hook
 * @author marc aschmann <maschmann@gmail.com>
 */
interface HookManagerInterface
{
    /**
     * @param HookInterface $hook
     * @param string $alias
     * @return mixed|void
     */
    public function addHook(HookInterface $hook, $alias);

    /**
     * get instance of configured hook
     *
     * @param string $alias
     * @return mixed
     */
    public function getHook($alias);

    /**
     * return all hooks from manager
     *
     * @return array
     */
    public function getHooks();

    /**
     * return all pre hooks
     *
     * @return array
     */
    public function getPreHooks();

    /**
     * return all post hooks
     *
     * @return array
     */
    public function getPostHooks();

    /**
     * return all content hooks
     *
     * @return array
     */
    public function getContentHooks();
}
