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

use \Michelf\Markdown;
use \Michelf\MarkdownExtra;

/**
 * Class PhpMarkdownParser
 *
 * @package Asm\MarkdownContentBundle\Parser
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Asm\MarkdownContentBundle\Parser\ParserInterface
 * @uses Asm\MarkdownContentBundle\Parser\ParserAbstract
 * @uses \Michelf\Markdown
 * @uses \Michelf\MarkdownExtra
 */
class PhpMarkdownParser extends ParserAbstract implements ParserInterface
{

    /**
     * @var php-markdown $parser
     */
    private $parser;

    /**
     * @var array
     */
    private $options;

    /**
     * allowed options keys
     *
     * @var array
     */
    private $allowedOptions;

    /**
     * will be called by constructor
     *
     * @param  array $options
     * @return mixed
     */
    public function init($options)
    {
        $this->allowedOptions = array(
            'empty_element_suffix',
            'tab_width',
            'no_markup',
            'no_entities',
            'predef_urls',
            'predef_titles',
            'fn_id_prefix',
            'fn_link_title',
            'fn_backlink_title',
            'fn_link_class',
            'fn_backlink_class',
            'code_class_prefix',
            'code_attr_on_pre',
            'predef_abbr',
        );

        if (isset($options['extended'])
            && true === $options['extended']
        ) {
            $this->parser = new Markdown();
        } else {
            $this->parser = new MarkdownExtra();
        }

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
        return $this->parser->transform($text);
    }

    /**
     * set multiple options supportet by the individual parsers
     *
     * @param  array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        foreach ($options as $optionName => $optionValue) {
            if (array_key_exists($this->allowedOptions, $optionName)) {
                $this->parser->{$optionName} = $optionValue;
            }
        }

        return $this;
    }
}
