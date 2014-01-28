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

use Asm\MarkdownContentBundle\Hook\HookInterface;

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
     * @param string $content
     * @return string
     */
    public function workContent($content)
    {
        $headers = array(
            'title'       => 'Title',
            'description' => 'Description',
            'author'      => 'Author',
            'date'        => 'Date',
            'robots'      => 'Robots',
            'template'    => 'Template'
        );

        // Add support for custom headers by hooking into the headers array
        $this->run_hooks('before_read_file_meta', array(&$headers));

        foreach ($headers as $field => $regex){
            if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $content, $match) && $match[1]){
                $headers[ $field ] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
            } else {
                $headers[ $field ] = '';
            }
        }

        if(isset($headers['date'])) $headers['date_formatted'] = date($config['date_format'], strtotime($headers['date']));

        return $headers;
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
