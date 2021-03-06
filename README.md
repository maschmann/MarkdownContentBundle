MarkdownContentBundle
========
Basic idea behind the project was to be able to easily provide, provision and version content without a database backend. Also quite tempting: The markdown syntax.

[![Build Status](https://travis-ci.org/maschmann/MarkdownContentBundle.png?branch=master)](https://travis-ci.org/maschmann/MarkdownContentBundle) [![Latest Stable Version](https://poser.pugx.org/asm/markdown-content-bundle/v/stable.png)](https://packagist.org/packages/asm/markdown-content-bundle) [![Total Downloads](https://poser.pugx.org/asm/markdown-content-bundle/downloads.png)](https://packagist.org/packages/asm/markdown-content-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maschmann/MarkdownContentBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maschmann/MarkdownContentBundle/?branch=master)
[![phpci build status](http://phpci.br0ken.de/build-status/image/2)](http://phpci.br0ken.de)

## What does it do?
You can configure following things:
 * Content directory
 * Markdown parser ([php-markdown](http://michelf.ca/projects/php-markdown/ "php-markdown") or [parsedown](http://parsedown.org "parsedown"))
 * Type of loader for the files (at the moment only file-loader)
 * And the prefix for your content routes

All URLs are dynamically generated and support subdirectories without limitations.
MarkdowncontentBundle also supports translations! If you put your directory structure into a locale directory like ```content/en_US/mycoolfile.md``` it will be loaded either when using w3c urls with locale or if locale is set in your kernel. If you want locale urls, please enable the config directive.

## Basics
Some things you need to know!

### Configuration
You can set following things in your app/config.yml:

    asm_markdown_content:
        content_directory: 'app/Resources/markdown'
        content_loader:    'file-loader'
        route_prefix:      'content'
        markdown_provider: 'php-markdown'
        #locale_url:        false

### Expansion
If you want, you can easily add new markdown parsers or content loaders, even hooks.
For each type there's an interface you can build a tagged service upon:

#### Loaders
Asm\MarkdownContentBundle\Content\ContentLoaderInterface

    asm_markdown_content.content_file_loader:
    class: 'Asm\MarkdownContentBundle\Content\ContentFileLoader'
    arguments:
        - '%kernel.root_dir%'
        - '%asm_markdown_content.content_directory%'
        - '%asm_markdown_content.content_path_depth%'
    tags:
        - { name: asm_markdown_content.content_loader, alias: file-loader }

#### Parsers
Asm\MarkdownContentBundle\Parser\ParserInterface

    asm_markdown_content.parsedown_parser:
        class: 'Asm\MarkdownContentBundle\Parser\ParsedownParser'
        tags:
            - { name: asm_markdown_content.parser, alias: parsedown }

#### Hooks
Asm\MarkdownContentBundle\Hook\HookDataInterface
Asm\MarkdownContentBundle\Hook\HookContentInterface

    asm_markdown_content.front_matter_content_hook:
        class: 'Asm\MarkdownContentBundle\Hook\FrontMatterContentHook'
        tags:
            - { name: asm_markdown_content.hook, alias: front_matter }

### Hook system
The system is based on two events:
 * pre-content conversion
 * post-content conversion

For each registered hook service you have to set the type of hook in the _getType()_ method. It's either 'post' or 'pre'. The hook just has one more interface method _workContent()_ which receives the content array.
Pre-hooks receive the file content ($content['content']) as an array of lines, post hook will get the whole stuff as a HTML string, because it's already markdown-converted.

    $content = array(
        'content' => array()|string,
        'data'    => array(),
    );

That's also the data structure you're needed to return from _workContent()_. What you're doing with the data is completely up to you. The main difference between 'pre' and 'post' is the state of either data nodes. In 'pre', all content is still raw markdown, data is maybe already prefilled by other hooks (metadata hook e.g.). 'post' gets the already converted html string from your configured markdown parser. There you have the possibility to change some tags, add classes, whatever you want.

### Templating
The base layout uses bootstrap3 via CDN and provides some base for your own designs. Just override

    vendor/asm/markdown-content-bundle/Asm/MarkdownContentBundle/Resources/views/layout.html.twig
in your own Bundle(s). Have a look at the variable names!
Content template:

    vendor/asm/markdown-content-bundle/Asm/MarkdownContentBundle/Resources/views/Content/index.html.twig

### Meta data
Since there is an accepted format for page meta in markdown, I've switched to front matter.
The general format is

    ---
    title: Awesome page title
    author: me, myself and I
    date: 2014/02/09
    sample_data: { some: data, more: data_stuff }
    ---

This block needs to be the first thing in your markdown file, no whitespaces or newlines before, and the FrontMatterContentHook will extract the contents as YAML and provide the data within the content array.
So you have the opportunity to place virtually everything additional you need witin that block.
Besides that, default metadata will be placed in the root of the data array.
They are the filled with blank content if not set via front matter:

    $defaults= array(
        'title'       => '',
        'description' => '',
        'author'      => '',
        'date'        => '',
        'robots'      => '',
        'content'     => '',
        'name'        => '',
        'keywords'    => '',
    );

The front matter block from above will result in this array:

    $data = array(
        'title'       => 'Awesome page title',
        'author'      => 'me, myself and I',
        'date'        => '2014/02/09',
        'description' => '',
        'robots'      => '',
        'content'     => '',
        'name'        => '',
        'keywords'    => '',
        'sample_data' => array(
            'some'    => 'data',
            'more'    => 'data_stuff',
        ),
    );

The data array is available in your TWIG template and fill the fields automatically ;-)

## Exporting of static pages
If you want to export all your markdown files as HTML, you can do so with following command:

    app/console asm:markdown:export <absolute_export_dir> -i <optional_import_dir>

The exporter will use the configured markdown parser and if no import directory is provided, the configured one will be used by default.
Your content is then rendered file by file into an equivalent folder stucture within the export directory, based on the provided templates.
Keep in mind to add any css/js files to your static content directory :-)

## Upcoming/planned
 * precaching for markdown file search on compiler pass
 * caching of markdown content
 * maybe more loader types
 * online editor

License
----

AsmMarkdownContentBundle is licensed under the MIT license. See the [LICENSE](Resources/meta/LICENSE) for the full license text.


**Free Software, Hell Yeah!**
