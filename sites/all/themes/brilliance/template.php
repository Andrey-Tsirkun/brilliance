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

  global $user;
  if (!$user->uid) {
    drupal_add_library('system', 'ui.dialog');
    drupal_add_library('system', 'effects.explode');
    drupal_add_library('system', 'effects.puff');
    drupal_add_library('system', 'effects.fade');
    $variables['login_button'] = l(t('Login'), 'user', array('attributes' => array('class' => array('user-login'))));
  }

  if (theme_get_setting('menu_state')) {
    global $base_url;
    drupal_add_js(array('navFixed' => TRUE, 'homeLinkURL' => $base_url), 'setting');
  }
  if (theme_get_setting('slider_animation')) {
    drupal_add_js(array('sliderAnimation' => TRUE), 'setting');
  }
  if (theme_get_setting('brilliance_slider')) {
    $variables['brilliance_slider'] = TRUE;
  }

  drupal_add_js(drupal_get_path('theme', 'brilliance') .'/js/brilliance.js', array('scope' => 'footer'));

  ///////Slider blyat!!1

  if (variable_get('theme_brilliance_first_install', TRUE)) {
    include_once('theme-settings.php');
    _brilliance_install();
  }
  //to print the banners
  $slides = brilliance_show_slides();
  $variables['slider'] = $slides;
}

/**
 *
 * @return
 *    html markup to show banners
 */
function brilliance_show_slides() {
  $slides = brilliance_get_banners(FALSE);
  $output = '';
  $buttons = '<div class="prevButton sliderButton"></div><div class="nextButton sliderButton"></div>';
  $items = array();
  foreach ($slides as $key => $value) {
    $items['items'][] = array(
        l('<img src="' . file_create_url($slides[$key]['image_path']) . '" alt="' . $slides[$key]['image_title'] . '" />' .
            '<div class="sliderTitle">' . $slides[$key]['image_title'] . '</div>' .
            '<div class="slideDescription">' . $slides[$key]['image_description'] . '</div>', $slides[$key]['image_url'],array('html' => TRUE))
    );
  }
  $output .= theme('item_list', $items) . $buttons;
  return $output;
}

function brilliance_get_banners($all = TRUE) {
  // Get all banners
  $slides = variable_get('theme_brilliance_banner_settings', array());
  $delay = theme_get_setting('slide_delay');
  $animation_speed = theme_get_setting('animation_speed');
  $caption_animation_speed = theme_get_setting('caption_animation_speed');
  drupal_add_js('var delay = "' . $delay . '"', 'inline');
  drupal_add_js('var animation_speed = "' . $animation_speed . '"', 'inline');
  drupal_add_js('var caption_animation_speed  = "'. $caption_animation_speed . '"', 'inline');
  // Create list of banner to return
  $slides_value = array();
  foreach ($slides as $slide) {
    $slide['weight'] = $slide['image_weight'];
    $slides_value[] = $slide;
  }

  // Sort image by weight
  usort($slides_value, 'drupal_sort_weight');

  return $slides_value;
}

/**
 * Set banner settings.
 *
 * @param  $value
 *    Settings to save
 */
function brilliance_set_banners($value) {
  variable_set('theme_brilliance_banner_settings', $value);
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
  $variables['author'] = t('Commented') . ': ' . $variables['author'];

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

function brilliance_preprocess_node(&$variables) {
  $variables['submitted'] = t('<span class="nodeSubmitted">Submitted by</span> !username <span class="onNode">on</span> !datetime', array(
      '!username' => $variables['name'],
      '!datetime' => $variables['date']
    )
  );
}

function brilliance_breadcrumb($variables) {
  $breadcrumb = $variables ['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb">' . implode('<span></span>', $breadcrumb) . '</div>';
    return $output;
  }
}
