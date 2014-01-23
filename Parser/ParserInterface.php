<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @namespace Asm\MarkdownContentBundle\Parser
 */
namespace Asm\MarkdownContentBundle\Parser;

/**
 * Interface ParserInterface
 *
 * @package Asm\MarkdownContentBundle\Parser
 * @author marc aschmann <maschmann@gmail.com>
 */
interface ParserInterface
{
    /**
     * will be called by abstract constructor
     *
     * @param array $options
´     */
    public function init($options);


    /**
     * parse markdown and return html content
     *
     * @param string $text
     * @return mixed
     */
    public function parseText($text);

    /**
     * set multiple options supported by the individual parsers
     *
     * @param array $options
     */
    public function setOptions($options);
}
