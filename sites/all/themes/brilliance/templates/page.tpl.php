<?php

/**
 * @file
 * Custom theme implementation to display a single Drupal page without
 * sidebars. The sidebars are hidden by regions_hidden for this theme, so
 * the default page.tpl.php will not work without throwing exceptions.
 */
?>

  <div id="page">

    <header class="header"><div class="section clearfix">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan">
          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong></div>
            <?php else: /* Use h1 when the content title is empty */ ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div> <!-- /#name-and-slogan -->
      <?php endif; ?>

      <?php print render($page['header']); ?>

    </div></header> <!-- /.section, /#header -->

    <main id="main" class="clearfix push">

      <?php if ($breadcrumb): ?>
        <div id="breadcrumb"><?php print $breadcrumb; ?></div>
      <?php endif; ?>

      <?php print $messages; ?>

      <?php if ($page['navigation']): ?>
        <nav class="navigation"><div class="section">
          <?php print render($page['navigation']); ?>
        </div></nav> <!-- /.section, /#navigation -->
      <?php endif; ?>

      <div id="content" class="column"><div class="section">

        <div class="page-top-wrapper <?php print $page_top_regions_class; ?>">
          <?php if ($page['page_top_first']): ?>
            <?php print render($page['page_top_first']); ?>
          <?php endif; ?>

          <?php if ($page['page_top_second']): ?>
            <?php print render($page['page_top_second']); ?>
          <?php endif; ?>

          <?php if ($page['page_top_third']): ?>
            <?php print render($page['page_top_third']); ?>
          <?php endif; ?>
        </div>

        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs = render($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div></div> <!-- /.section, /#content -->
    </main> <!-- /#main -->

    <footer id="footer"><div class="section">
      <?php print render($page['footer']); ?>
    </footer></div> <!-- /.section, /#footer -->

  </div> <!-- /#page-wrapper -->
