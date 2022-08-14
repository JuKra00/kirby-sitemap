# Kirby Sitemap

This plugin adds a multilanguage enabled sitemap.xml to your [Kirby CMS](https://getkirby.com) website.

****

## Requirements
- Kirby **^3.5**

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-sitemap`.

### Git submodule

```sh
git submodule add https://github.com/jukra00/kirby-sitemap.git site/plugins/kirby-sitemap
```

### Composer

```sh
composer require jukra00/kirby-sitemap
```

## Usage

The plugin automatically adds `/sitemap.xml` and `/sitemap` routes to your website, which will generate a valid XML Sitemap.

You can include a link to the sitemap by adding this snippet to the head of each page.

```php
<?= snippet('sitemap'); ?>
```

## Options

You can define the following options inside your `site/config/config.php` file.

| key                           |   default   | description                                                               |
| :---------------------------- | :---------: | :------------------------------------------------------------------------ |
| `jukra00.kirby-sitemap.ignore_ids`          |    `[]`     | Add an array of page ids, the sitemap should ignore. e.g. `['thanks']`     |
| `jukra00.kirby-sitemap.ignore_templates` | `['error']` | Add an array of template ids, the sitemap should ignore. e.g. `['error']` |

### Advanced options
You can also use closures in each option that return an array. This way you can for example use panel fields to define your ignores.

```php
# config.php
return [
  'jukra00.kirby-sitemap' => [
    'ignore_ids' => function () {
      # Get all published pages with meta_robots fields value 'noindex'
      $ignoredPages = site()->pages()->published()->index()->filterBy('meta_robots', 'noindex');
      # Return array of ids
      return $ignoredPages->pluck('id');
    }
  ]
]
```

## License

MIT

## Credits

This Plugin is based on the cookbook article [Sitemap for search engines](https://getkirby.com/docs/cookbook/content/sitemap).
