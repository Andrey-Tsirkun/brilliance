<?php

function brilliance_preprocess_region(&$variables) {
  $region_list = system_region_list('brilliance');
}

function brilliance_preprocess_page(&$variables) {

  if(theme_get_setting('social_icons', 'brilliance')) {
    $social_links_array = array();

    if(theme_get_setting('fb_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('Facebook'), theme_get_setting('fb_url', 'brilliance'), array(
          'attributes' => array(
              'target'=>'_blank',
              'class' => 'facebook-icon',
              'title' => t('Facebook Account'),
              'data-tooltip' => t('Facebook Account')
          )
      ));
    }
    if(theme_get_setting('twitter_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('Twitter'), theme_get_setting('twitter_url', 'brilliance'), array(
          'attributes' => array(
            'target'=>'_blank',
            'class' => 'twitter-icon',
            'title' => t('Twitter Account'),
            'data-tooltip' => t('Twitter Account')
          )
      ));
    }
    if(theme_get_setting('youtube_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('Youtube'), theme_get_setting('youtube_url', 'brilliance'), array(
              'attributes' => array(
                  'target'=>'_blank',
                  'class' => 'youtube-icon',
                  'title' => t('Youtube Account'),
                  'data-tooltip' => t('Youtube Account')
              ))
      );
    }
    if(theme_get_setting('googleplus_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('Google+'), theme_get_setting('googleplus_url', 'brilliance'), array(
          'attributes' => array(
              'target'=>'_blank',
              'class' => 'googleplus-icon',
              'title' => t('Google+ Account'),
              'data-tooltip' => t('Google+ Account')
          ))
      );
    }
    if(theme_get_setting('pinterest_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('Pinterest'), theme_get_setting('pinterest_url', 'brilliance'), array(
          'attributes' => array(
              'target'=>'_blank',
              'class' => 'pinterest-icon',
              'title' => t('Pinterest Account'),
              'data-tooltip' => t('Pinterest Account')
          ))
      );
    }
    if(theme_get_setting('linkedin_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('LinkedIn'), theme_get_setting('linkedin_url', 'brilliance'), array(
          'attributes' => array(
              'target'=>'_blank',
              'class' => 'linkedin-icon',
              'title' => t('LinkedIn Account'),
              'data-tooltip' => t('LinkedIn Account')
          ))
      );
    }
    if(theme_get_setting('instagram_url', 'brilliance')) {
      $social_links_array['items'][] = l(t('Instagram'), theme_get_setting('instagram_url', 'brilliance'), array(
          'attributes' => array(
              'target'=>'_blank',
              'class' => 'instagram-icon',
              'title' => t('Instagram Account'),
              'data-tooltip' => t('Instagram Account')
          ))
      );
    }

    $variables['social_links'] = theme('item_list', $social_links_array);
  }
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

  global $user;
  if (!$user->uid) {
    drupal_add_library('system', 'ui.dialog');
    drupal_add_library('system', 'effects.explode');
    drupal_add_library('system', 'effects.puff');
    drupal_add_library('system', 'effects.fade');
    $variables['login_button'] = l(t('Login'), 'user', array('attributes' => array('class' => array('user-login'))));
  }

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

function brilliance_form_user_login_alter( &$form, &$form_state, $form_id ) {
  $form['name']['#attributes']['placeholder'] = t( 'Username' );
  $form['pass']['#attributes']['placeholder'] = t( 'Password' );
}

function brilliance_block_view_user_login_alter (&$data, $block) {
  unset($data['subject']);
}
