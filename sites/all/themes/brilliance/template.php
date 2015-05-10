<?php

function brilliance_preprocess_region(&$variables) {
  $region_list = system_region_list('brilliance');
}

function brilliance_preprocess_page(&$variables) {
  /** @var TYPE_NAME $variables */

  /*$page_top_regions = array(
    $variables['page']['page_top_first'],
    $variables['page']['page_top_second'],
    $variables['page']['page_top_third']
  );

  $page_top_regions_counter = 0;
  foreach ($page_top_regions as $value) {
    if (!empty($value)) {
      $page_top_regions_counter++;
    }
  }

  $variables['page_top_regions_class'] = 'page-top-' . $page_top_regions_counter;

  $page_bottom_regions = array(
    $variables['page']['page_bottom_first'],
    $variables['page']['page_bottom_second'],
    $variables['page']['page_bottom_third'],
    $variables['page']['page_bottom_third']
  );

  $page_bottom_regions_counter = 0;
  foreach ($page_bottom_regions as $value) {
    if (!empty($value)) {
      $page_bottom_regions_counter++;
    }
  }

  $variables['page_bottom_regions_class'] = 'page-bottom-' . $page_bottom_regions_counter;*/


  if (theme_get_setting('menu_state')) {
    drupal_add_js(array('navFixed' => TRUE), 'setting');
  }
  if (theme_get_setting('brilliance_slider')) {
    $variables['brilliance_slider'] = TRUE;
  }

  drupal_add_js(drupal_get_path('theme', 'brilliance') .'/js/brilliance.js', array('scope' => 'footer'));
}

function brilliance_preprocess_html(&$vars) {
  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1, maximum-scale=1',
    ),
  );
  drupal_add_html_head($viewport, 'viewport');
}

/**
 * Process variables for comment.tpl.php.
 *
 * @see comment.tpl.php
 */
function brilliance_preprocess_comment(&$variables) {
  $comment = $variables['elements']['#comment'];
  $uri = entity_uri('comment', $comment);
  $variables['permalink'] = l(t('#'), $uri['path'], $uri['options']);
  $variables['author'] = t('Author') . ': ' . $variables['author'];

  //Add class to comment if it have user picture.
  if ($variables['picture']) {
    $variables['classes_array'][] = 'withavatar';
  }
}
