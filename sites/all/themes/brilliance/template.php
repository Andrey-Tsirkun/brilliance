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
    if(!empty($value)) {
      print $value;
      $page_top_regions_counter++;
    }
  }

  $variables['page_top_regions_class'] = 'page-top-' . $page_top_regions_counter;
}
