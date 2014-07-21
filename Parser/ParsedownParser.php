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

use \Parsedown;

/**
 * Class ParsedownParser
 *
 * @package Asm\MarkdownContentBundle\Parser
 * @author marc aschmann <maschmann@gmail.com>
 */
class ParsedownParser extends ParserAbstract implements ParserInterface
{

    /**
     * @var Parsedown $parser
     */
    private $parser;

    /**
     * will be called by constructor
     *
     * @param  array $options
     * @return mixed
     */
    public function init($options)
    {
        $this->parser = Parsedown::instance();

        $this->setOptions($options);
    }

    /**
     * parse markdown and return html content
     *
     * @param  string $text
     * @return mixed
     */
    public function parseText($text)
    {
        return $this->parser->parse($text);
    }

    /**
     * set multiple options supportet by the individual parsers
     *
     * @param array $options
     */
    public function setOptions($options)
    {
        if (isset($options['breaks_enabled'])) {
            $this->parser->set_breaks_enabled($options['breaks_enabled']);
        }
    }

}
