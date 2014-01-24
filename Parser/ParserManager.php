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

/**
 * Class ParserManager
 *
 * @package Asm\MarkdownContentBundle\Parser
 * @author marc aschmann <maschmann@gmail.com>
 */
class ParserManager implements ParserManagerInterface
{

    /**
     * classname of managed parser, implementing ParserInterface
     *
     * @var array
     */
    private $parsers;


    /**
     * default constructor
     */
    public function __construct()
    {
        $this->parsers = array();
    }

    /**
     * @param ParserInterface $parser
     * @param string $alias
     * @return mixed|void
     */
    public function addParser(ParserInterface $parser, $alias)
    {
        $this->parsers[$alias] = $parser;
    }

    /**
     * get instance of configured parser
     *
     * @param string $alias
     * @return mixed
     */
    public function getParser($alias)
    {
        if (array_key_exists($alias, $this->parsers)) {
            return $this->parsers[$alias];
        } else {
            return false;
        }
    }
}
