<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ContentController
 *
 * @package Asm\MarkdownContentBundle\Controller
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Bundle\FrameworkBundle\Controller\Controller
 */
class ContentController extends Controller
{
    public function indexAction($page)
    {
        //$provider = $this->get('asm_markdown_content.content_provider');
        $content = array(
            'data' => array(
                'charset'     => 'utf-8',
                'title'       => 'testing title',
                'description' => 'testing description',
                'author'      => 'marc aschmann',
            ),
            'content' => 'XxxXXXxxxxxXXXXXXXXXXXXXxxxxxxxxxxxxxxxxxxXXXXXXXXXXXXXXXXXx',
        );

        return $this->render(
            'AsmMarkdownContentBundle:Content:index.html.twig',
            array(
                'data'     => $content['data'],
                'content'  => $content['content'],
                'language' => $this->get('request')->getLocale(),
            )
        );
    }
}
