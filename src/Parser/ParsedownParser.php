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

use Asm\MarkdownContentBundle\Parser\ParserInterface;
use \Parsedown;

/**
 * Class ParsedownParser
 *
 * @package Asm\MarkdownContentBundle\Parser
 * @author marc aschmann <maschmann@gmail.com>
 */
final class ParsedownParser implements ParserInterface
{

    /**
     * @var Parsedown $parser
     */
    private $parser;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->parser = Parsedown::instance();

        $this->setOptions($options);
    }

    /**
     * parse markdown and return html content
     *
     * @param string $text
     * @return mixed
     */
    public function parseText($text)
    {
        return $this->parser->parse($text);
    }

    /**
     * set multiple options supported by the individual parsers
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
