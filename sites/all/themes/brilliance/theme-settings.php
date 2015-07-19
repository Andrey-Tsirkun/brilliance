<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */

function brilliance_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['brilliance_settings'] = array(
      '#type' => 'fieldset',
      '#title' => t('Brilliance Theme Settings'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
  );
  $form['brilliance_settings']['menu_state'] = array(
      '#type' => 'checkbox',
      '#title' => t('Menu state'),
      '#description' => t('Enable fixed menu.'),
      '#default_value' => theme_get_setting('menu_state', 'brilliance'),
  );
  $form['brilliance_settings']['footer_social_icons'] = array(
      '#type' => 'fieldset',
      '#title' => t('Social links'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );
  $form['brilliance_settings']['footer_social_icons']['social_icons'] = array(
      '#type' => 'checkbox',
      '#title' => t('Social icons'),
      '#default_value' => theme_get_setting('social_icons', 'brilliance'),
      '#description' => t('Enable social icons.'),
  );
  $form['brilliance_settings']['footer_social_icons']['fb_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook URL'),
      '#default_value' => theme_get_setting('fb_url', 'brilliance'),
      '#description' => t('Enter your Facebook profile URL.'),
  );
  $form['brilliance_settings']['footer_social_icons']['twitter_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter URL'),
      '#default_value' => theme_get_setting('twitter_url', 'brilliance'),
      '#description' => t('Enter your Twitter profile URL.'),
  );
  $form['brilliance_settings']['footer_social_icons']['youtube_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Youtube URL'),
      '#default_value' => theme_get_setting('youtube_url', 'brilliance'),
      '#description' => t('Enter your Youtube profile URL.'),
  );
  $form['brilliance_settings']['footer_social_icons']['googleplus_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Google+ URL'),
      '#default_value' => theme_get_setting('googleplus_url', 'brilliance'),
      '#description' => t('Enter your Google+ profile URL.'),
  );
  $form['brilliance_settings']['footer_social_icons']['pinterest_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Pinterest URL'),
      '#default_value' => theme_get_setting('pinterest_url', 'brilliance'),
      '#description' => t('Enter your Google+ profile URL.'),
  );
  $form['brilliance_settings']['footer_social_icons']['linkedin_url'] = array(
      '#type' => 'textfield',
      '#title' => t('LinkedIn URL'),
      '#default_value' => theme_get_setting('linkedin_url', 'brilliance'),
      '#description' => t('Enter your LinkedIn profile URL.'),
  );
  $form['brilliance_settings']['footer_social_icons']['instagram_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Instagram URL'),
      '#default_value' => theme_get_setting('instagram_url', 'brilliance'),
      '#description' => t('Enter your Instagram profile URL.'),
  );

  //Slider

  $form['brilliance_settings']['brilliance_slider'] = array(
      '#type' => 'fieldset',
      '#title' => t('Brilliance slider'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );

  $form['brilliance_settings']['brilliance_slider']['slide'] = array(
      '#type' => 'fieldset',
      '#title' => t('Slide managment [Upload images with dimension 960*502]'),
      '#weight' => 1,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  // Image upload section ======================================================
  $banners = brilliance_get_banners_tpl();

  $form['brilliance_settings']['brilliance_slider']['slide']['images'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Slide images'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#tree' => TRUE,
  );

  $i = 0;
  foreach ($banners as $image_data) {
    $form['brilliance_settings']['brilliance_slider']['slide']['images'][$i] = array(
        '#type' => 'fieldset',
        '#title' => t('Image !number', array('!number' => $i + 1)),
        '#weight' => $i,
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#tree' => TRUE,
      // Add image config form to $form
        'image' => _brilliance_banner_form($image_data),
    );

    $i++;
  }

  $form['brilliance_settings']['brilliance_slider']['slide']['image_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload a new slide'),
      '#element_validate' => array('brilliance_images_validate'),
  );

  $form['brilliance_settings']['brilliance_slider']['slide']['slider_animation'] = array(
      '#type' => 'checkbox',
      '#title' => t('Autoscroll'),
      '#description' => t('Add autoscroll to Brilliance Slider'),
      '#element_validate' => array('brilliance_images_validate'),
  );

  $form['#submit'][]   = 'brilliance_settings_submit';
  //$form['slide']['image_upload']['#element_validate'][] = 'brilliance_settings_submit';
  return $form;
}

function brilliance_images_validate ($element, &$form_state) {
  if ($_FILES['files']['tmp_name']['image_upload']) {
    $image_data = getimagesize($_FILES['files']['tmp_name']['image_upload']);
    $image_width = 1104;
    $image_height = 300;
    if (isset($image_data) && $image_data[0] != $image_width && $image_data[1] != $image_height) {
      form_error($element, t('Please enter image with right dimension.'));
    }
  }
}

function brilliance_get_banners_tpl($all = TRUE) {
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
    //$slide['weight'] = $slide['image_weight'];
    $slides_value[] = $slide;
  }

  // Sort image by weight
  //usort($slides_value, 'drupal_sort_weight');

  return $slides_value;
}

function _brilliance_install() {
  // Default data
  $file = new stdClass;
  $slides = array();
  // Source base for images
  $src_base_path = drupal_get_path('theme', 'brilliance');
  $default_slides = theme_get_setting('default_slides');
  // Put all image as banners
  foreach ($default_slides as $i => $data) {
    $file -> uri = $src_base_path . '/' . $data['image_path'];
    $file -> filename = $file->uri;
    $slide = _brilliance_save_image($file);
    unset($data['image_path']);
    $slide = array_merge($slide, $data);
    $slides[$i] = $slide;
  }
  // Save banner data
  brilliance_set_slides($slides);
  // Flag theme is installed
  variable_set('theme_brilliance_first_install', FALSE);
}

function _brilliance_banner_form($image_data) {
  $img_form = array();

  // Image preview
  $img_form['image_preview'] = array(
      '#markup' => theme('image', array('path' => $image_data['image_thumb'])),
  );

  // Image path
  $img_form['image_path'] = array(
      '#type' => 'hidden',
      '#value' => $image_data['image_path'],
  );

  // Thumbnail path
  $img_form['image_thumb'] = array(
      '#type' => 'hidden',
      '#value' => $image_data['image_thumb'],
  );


  // Slide URL.
  $img_form['image_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Url'),
      '#default_value' => $image_data['image_url'],
  );

  // Slide title.
  $img_form['image_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => $image_data['image_title'],
  );

  // Slide title.
  $img_form['image_description'] = array(
      '#type' => 'textarea',
      '#title' => t('Title'),
      '#default_value' => $image_data['image_description'],
  );

  // Delete image.
  $img_form['image_delete'] = array(
      '#type' => 'checkbox',
      '#title' => t('Delete image.'),
      '#default_value' => FALSE,
  );

  return $img_form;
}

function brilliance_settings_submit($form, &$form_state) {
  $settings = array();
  $image_width = 1140;
  $image_height = 300;

  if ($file = file_save_upload('image_upload')) {
    $image_data = getimagesize($file->uri);
    if ($image_data[0] != $image_width && $image_data[1] != $image_height) {
      //@todo update text in t() function below
      form_set_error('image_upload', t('Please upload valid image.You try to upload image with !w x !h', array('!w' => $image_data[0], ) . $image_data[0]  . 'x' . $image_data[1] . ' dimension.'));
      $form_state['error'] = TRUE;
      return;
    }
  }

  // Update image field
  foreach ($form_state['input']['images'] as $image) {
    if (is_array($image)) {
      $image = $image['image'];

      if ($image['image_delete']) {
        // Delete banner file
        file_unmanaged_delete($image['image_path']);
        // Delete banner thumbnail file
        file_unmanaged_delete($image['image_thumb']);
      } else {
        // Update image
        $settings[] = $image;
      }
    }
  }

  // Check for a new uploaded file, and use that if available.
  if ($file = file_save_upload('image_upload')) {
    $file -> status = FILE_STATUS_PERMANENT;
    if ($image = _brilliance_save_image($file)) {
      // Put new image into settings
      $settings[] = $image;
    }
  }

  // Save settings
  brilliance_set_slides($settings);
}

/**
 * Save file uploaded by user and generate setting to save.
 *
 * @param  $file
 *    File uploaded from user
 *
 * @param  $banner_folder
 *    Folder where save image
 *
 * @param  $banner_thumb_folder
 *    Folder where save image thumbnail
 *
 * @return
 *    Array with file data.
 *    FALSE on error.
 */
function _brilliance_save_image($file, $slide_folder = 'public://brilliance-slider/', $slide_thumb_folder = 'public://brilliance-slider/thumb/') {
  // Check directory and create it (if not exist)
  _brilliance_check_dir($slide_folder);
  _brilliance_check_dir($slide_thumb_folder);

  $parts = pathinfo($file->filename);
  $destination = $slide_folder . $parts['basename'];
  $setting = array();

  $file -> status = FILE_STATUS_PERMANENT;

  // Copy temporary image into banner folder
  if ($img = file_copy($file, $destination, FILE_EXISTS_REPLACE)) {
    // Generate image thumb
    $image = image_load($destination);
    $small_img = image_scale($image, 300, 100);
    $image->source = $slide_thumb_folder . $parts['basename'];
    image_save($image);

    // Set image info
    $setting['image_path'] = $destination;
    $setting['image_thumb'] = $image->source;
    $setting['image_url'] = '';
    $setting['image_title'] = '';
    $setting['image_description'] = '';
    $setting['image_visibility'] = '*';
    return $setting;
  }

  return FALSE;
}

function brilliance_set_slides($value) {
  variable_set('theme_brilliance_banner_settings', $value);
}

/**
 * Check if folder is available or create it.
 *
 * @param  $dir
 *    Folder to check
 */
function _brilliance_check_dir($dir) {
  // Normalize directory name
  $dir = file_stream_wrapper_uri_normalize($dir);

  // Create directory (if not exist)
  file_prepare_directory($dir,  FILE_CREATE_DIRECTORY);
}
