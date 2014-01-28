MarkdownContentBundle
=====================
Basic idea behind the project was to be able to easily provide, provision and version content without a database backend. Also quite tempting: The markdown syntax.

## What does it do?
You can configure following things:
 * Content directory
 * Markdown parser ([php-markdown](http://michelf.ca/projects/php-markdown/ "php-markdown") or [parsedown](http://parsedown.org "parsedown"))
 * Type of loader for the files (at the moment only file-loader)
 * And the prefix for your content routes

All URLs are dynamically generated and support subdirectories without limitations.

## Basics
Some things you need to know!

### Configuration
You can set following things in your app/config.yml:

    asm_markdown_content:
        content_directory # app/Resources/markdown
        content_loader    # file-loader
        route_prefix      # content
        markdown_provider # php-markdown

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

    asm_markdown_content.metadata_content_hook:
        class: 'Asm\MarkdownContentBundle\Hook\MetadataContentHook'
        tags:
            - { name: asm_markdown_content.hook, alias: metadata }

### Hook system
The system is based on two events:
 * pre-content conversion
 * post-content conversion
