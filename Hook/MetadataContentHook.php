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

/**
 * Class MetadataContentHook
 *
 * @package Asm\MarkdownContentBundle\Content
 * @author marc aschmann <maschmann@gmail.com>
 * uses Asm\MarkdownContentBundle\Hook\HookInterface
 */
class MetadataContentHook implements HookInterface
{
    /**
     * main method of hook, changes content
     *
     * @param  array $content
     * @return array
     */
    public function workContent($content)
    {
        $headers = $this->extractHeaders($content['content']);
        // merge header
        $content['data'] = array_replace_recursive($content['data'], array('meta' => $headers));

        // clean out multiline comment from document header
        $content['content'] = preg_replace('!/\*.*?\*/!s', '', $content['content']);

        return $content;
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

    /**
     * extract header block from content
     *
     * @param  string $content
     * @return array
     */
    private function extractHeaders($content)
    {
        $headers = array(
            'title'       => 'Title',
            'description' => 'Description',
            'author'      => 'Author',
            'date'        => 'Date',
            'robots'      => 'Robots',
            'template'    => 'Template',
        );

        foreach ($headers as $field => $regex) {
            if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $content, $match) && $match[1]) {
                $headers[$field] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
            } else {
                $headers[$field] = '';
            }
        }

        if (isset( $headers[ 'date' ] )) {
            $date = new \DateTime($headers[ 'date' ]);
            $headers[ 'date_formatted' ] = $date->format('Y-m-d H:i:s');
        }

        return $headers;
    }
}
