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
 * Class HookLoader
 *
 * @package Asm\MarkdownContentBundle\Hook
 * @author marc aschmann <maschmann@gmail.com>
 */
class HookManager implements HookManagerInterface
{
    /**
     * @var array
     */
    private $hooks;

    /**
     * default constructor
     */
    public function __construct()
    {
        $this->hooks = array(
            'pre'     => array(),
            'post'    => array(),
        );
    }

    /**
     * @param  HookInterface $hook
     * @param  string        $alias
     * @return mixed|void
     */
    public function addHook(HookInterface $hook, $alias)
    {
        $this->hooks[$hook->getType()][$alias] = $hook;
    }

    /**
     * get instance of configured hook
     *
     * @param  string $alias
     * @return mixed
     */
    public function getHook($alias)
    {
        foreach ($this->hooks as $hooks) {
            if (array_key_exists($alias, $hooks)) {
                return $hooks[$alias];
            } else {
                return false;
            }
        }
    }

    /**
     * return all collected hooks
     *
     * @return array
     */
    public function getHooks()
    {
        return $this->hooks;
    }

    /**
     * return all pre hooks
     *
     * @return array
     */
    public function getPreHooks()
    {
        return $this->hooks['pre'];
    }

    /**
     * return all post hooks
     *
     * @return array
     */
    public function getPostHooks()
    {
        return $this->hooks['post'];
    }
}
