<?php

declare(strict_types=1);

Kirby::plugin('jukra00/kirby-sitemap', [
  'options' => [
    'ignore_ids' => [],
    'ignore_templates' => ['error']
  ],
  'snippets' => [
    'sitemap' => __DIR__ . '/snippets/sitemap.php',
    'sitemap_xml' => __DIR__ . '/snippets/sitemap_xml.php',
  ],
  "routes" => [
    [
      'pattern' => 'sitemap.xml',
      'action' => function () {
        // Get all published pages
        $pages = site()->pages()->published()->index();
        // Get Languages
        $languages = kirby()->languages();
        // Get options from config
        $ignore_ids = kirby()->option('jukra00.kirby-sitemap.ignore_ids');
        $ignore_templates = kirby()->option('jukra00.kirby-sitemap.ignore_templates');
        // Validate options
        if (is_callable($ignore_ids)) {
          $ignore_ids = $ignore_ids();
        }
        if (!is_array($ignore_ids)) {
          $ignore_ids = [$ignore_ids];
        }
        if (is_callable($ignore_templates)) {
          $ignore_templates = $ignore_templates();
        }
        if (!is_array($ignore_templates)) {
          $ignore_templates = [$ignore_templates];
        }
        // Render sitemap snippet
        $content = snippet('sitemap_xml', compact('pages', 'ignore_ids', 'ignore_templates', 'languages'), true);
        // Return sitemap
        return new Kirby\Cms\Response($content, 'application/xml');
      },
    ],
    [
      'pattern' => '([a-z]{2}/)?sitemap(.xml)?',
      'action' => function () {
        return go('sitemap.xml', 301);
      },
    ],
  ]
]);
