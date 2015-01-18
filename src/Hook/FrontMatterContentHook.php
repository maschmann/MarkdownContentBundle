<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/** @namespace Asm\MarkdownContentBundle\Hook */
namespace Asm\MarkdownContentBundle\Hook;

use Symfony\Component\Yaml\Yaml;

/**
 * Class FrontMatterContentHook
 *
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Asm\MarkdownContentBundle\Hook\HookInterface
 * @uses Symfony\Component\Yaml\Yaml
 */
final class FrontMatterContentHook implements HookInterface
{
    /**
     * @var array
     */
    private $defaults= array(
        'title'       => '',
        'description' => '',
        'author'      => '',
        'date'        => '',
        'robots'      => '',
        'content'     => '',
        'name'        => '',
        'keywords'    => '',
    );

    /**
     * main method of hook, changes content
     *
     * @param  array $content
     * @return array
     */
    public function workContent($content)
    {
        return $this->extractFrontMatter($content);
    }

    /**
     * @param  array $content
     * @return array
     */
    private function extractFrontMatter(array $content)
    {
        $token          = "---\n";
        $frontMatter    = array();
        $frontMatterRaw = array();

        // initial check for front matter
        if (false !== strpos($content['content'][0], $token)) {
            // remove starting token
            array_shift($content['content']);

            while ($content['content']) {
                $line = array_shift($content['content']);

                // jump out if we've reached the end of front matter
                if (false !== strpos($line, $token)) {
                    break;
                }
                $frontMatterRaw[] = $line;
            }

            // cross fringers and pray ;-)
            $frontMatter = Yaml::parse(implode('', $frontMatterRaw));
        }

        return array(
            'data' => array_replace_recursive(
                $this->defaults,
                $content['data'],
                $frontMatter
            ),
            'content' => $content['content'],
        );
    }

    /**
     * defines type of hook, pre or post conversion
     *
     * @return string
     */
    public function getType()
    {
        return 'pre';
    }
}
