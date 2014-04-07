<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Cache;

/**
 * Interface CacheInterface
 *
 * @package Asm\MarkdownContentBundle\Cache
 * @author marc aschmann <maschmann@gmail.com>
 */
interface CacheInterface
{

    /**
     * @param string $key
     * @return mixed
     */
    public function getElement($key);

    /**
     * 
     *
     * @param string $key key to store under
     * @param mixed $value element to store
     * @param integer $ttl time to live for the element
     */
    public function setElement($key, $value, $ttl=0);

    /**
     * clear specific cache key
     *
     * @param string $key
     * @return mixed
     */
    public function clear($key);

    /**
     * clear all cache entries
     */
    public function clearAll();
}
