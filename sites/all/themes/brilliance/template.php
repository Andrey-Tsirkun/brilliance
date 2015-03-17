<?php

function brilliance_preprocess_region(&$variables) {
  $region_list = system_region_list('brilliance');
  //dsm($region_list);
  //dsm($variables);
}

function brilliance_preprocess_page(&$variables) {
  /** @var TYPE_NAME $variables */
  $page_top_regions = array(
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

  if (theme_get_setting('menu_state') == 'fixed_menu'){
    //print 'PADLA';
    drupal_add_js(array('navFixed' => TRUE), 'setting');
  }

  drupal_add_js(drupal_get_path('theme', 'brilliance') .'/js/brilliance.js', array('scope' => 'footer'));
}
