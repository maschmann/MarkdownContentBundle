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
 */
interface ParserManagerInterface
{

    /**
     * get instance of configured parser
     *
     * @return mixed
     */
    public function getParser();

}
