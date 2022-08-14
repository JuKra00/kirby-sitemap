<?php

use Kirby\Toolkit\V;
?>
<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.w3.org/TR/xhtml11/xhtml11_schema.html http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/TR/xhtml11/xhtml11_schema.html">
  <?php foreach ($pages as $p) :
    if (V::in($p->uri(), $ignore_ids)) :
      continue;
    endif;
    if (V::in($p->intendedTemplate(), $ignore_templates)) :
      continue;
    endif;
  ?>
    <url>
      <loc><?= html($p->url()) ?></loc>
      <?php foreach ($languages as $lang) :
        if ($p->content($lang->code())->exists()) : ?>
          <xhtml:link rel="alternate" hreflang="<?= $lang->code() ?>" href="<?= $p->url($lang->code()) ?>" />
      <?php endif;
      endforeach; ?>
      <lastmod><?= option('date.handler') === 'strftime' ? $p->modified('%FT%X%z') : $p->modified('c') ?></lastmod>
      <priority><?= $p->isHomePage() ? 1 : number_format(0.5 / $p->depth(), 1) ?></priority>
    </url>
  <?php
  endforeach; ?>
</urlset>