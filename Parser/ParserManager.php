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
     * class
     *
     * @var ParserInterface $parser
     */
    static private $parser;


    /**
     * @param $parser
     */
    public function __construct($parser)
    {
        self::$parser = new $parser;
    }

    /**
     * get instance of configured parser
     *
     * @return mixed
     */
    public function getParser()
    {

        // TODO: Implement getParser() method.
    }
}
