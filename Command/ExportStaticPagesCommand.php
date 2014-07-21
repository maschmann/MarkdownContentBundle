<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

/**
 * Class ExportStaticPagesCommand
 *
 * @package Asm\MarkdownContentBundle\Command
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
 * @uses Symfony\Component\Console\Input\InputArgument
 * @uses Symfony\Component\Console\Input\InputInterface
 * @uses Symfony\Component\Console\Input\InputOption
 * @uses Symfony\Component\Console\Output\OutputInterface
 * @uses Symfony\Component\Finder\Finder
 */
class ExportStaticPagesCommand extends ContainerAwareCommand
{
    /**
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('asm:markdown:export')
            ->setDescription('Export all your markdown as html content into a specific directory')
            ->addArgument('export', InputArgument::REQUIRED, 'Where do you want to export to?')
            ->addOption('import', 'i', InputArgument::OPTIONAL, 'Where are your markdown files? Defaults to config dir');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Symfony\Component\Finder\Finder $finder */
        $finder = new Finder();
        /** @var \Asm\MarkdownContentBundle\Content\ContentProvider $contentProvider */
        $contentProvider = $this->getContainer()->get('asm_markdown_content.content_provider')
            ->setLoader('static-loader');
        $twig = $this->getContainer()->get('templating');
        $source = $input->getOption('import');
        $export = $input->getArgument('export');

        if (empty($source)) {
            $source = $this->getContainer()->getParameter('asm_markdown_content.content_directory');
        }

        // make sure our export dir exists
        if (false === is_dir($export)) {
            mkdir($export, 0764, true);
        }

        $output->writeln('exporting to ' . $export);

        $finder->files()->name('*.md')->in($source);
        $output->writeln('exporting ' . $finder->count() . ' files to html');
        /** @var \SplFileInfo $file */
        foreach ($finder as $file) {
            $content = $contentProvider->getContent($file);
            $targetFilename = str_replace('.md', '.html', $file->getFilename());
            $subdir = str_replace($source, '', $file->getPath());
            $filepath = $export . $subdir . '/' . $targetFilename;

            // render
            $html = $twig->render(
                'AsmMarkdownContentBundle:Content:index.html.twig',
                array(
                    'data'     => $content['data'],
                    'content'  => $content['content'],
                    'language' => 'en',//$this->get('request')->getLocale(),
                )
            );

            if (false === is_dir($export . $subdir)) {
                mkdir($export . $subdir, 0764, true);
            }

            $output->writeln('writing ' . $subdir . '/' . $targetFilename);
            file_put_contents($filepath, $html);
        }

        $output->writeln('export done');
    }
}
