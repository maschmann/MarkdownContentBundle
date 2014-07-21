<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Parser;

/**
 * Interface ParserManagerInterface
 *
 * @package Asm\MarkdownContentBundle\Parser
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Asm\MarkdownContentBundle\Parser\ParserInterface
 */
interface ParserManagerInterface
{

    /**
     * set parser
     *
     * @param  ParserInterface $parser
     * @param  string          $alias
     * @return mixed
     */
    public function addParser(ParserInterface $parser, $alias);

    /**
     * get instance of configured parser
     *
     * @param $alias
     * @return mixed
     */
    public function getParser($alias);

}
