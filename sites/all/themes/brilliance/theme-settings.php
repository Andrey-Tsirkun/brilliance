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
    '#default_value' => (theme_get_setting('menu_state', 'brilliance')),
  );
  /*$form['brilliance_settings']['brilliance_slider'] = array(
    '#type' => 'checkbox',
    '#title' => t('Brilliance Slider'),
    '#description' => t('Enable Brilliance Slider'),
    '#default_value' => (theme_get_setting('brilliance_slider', 'brilliance')),
  );
  $form['brilliance_settings']['slider_upload'] = array(
    '#title' => t('Slider items'),
    '#description' => t('Upload and configure each slider item.'),
    '#type' => 'managed_file',
    '#upload_location' => 'public://brilliance-slider/',
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
      'file_validate_is_image' => array(),
      'file_validate_size' => array(1 * 1140 * 768),
    ),
    '#default_value' => theme_get_setting('slider_upload'),
    '#progress_indicator' => 'bar',
    '#attributes' => array('multiple' => 'multiple'),
  );
  $form['#submit'][] = 'brilliance_settings_form_submit';
  $themes = list_themes();
  $active_theme = $GLOBALS['theme_key'];
  $form_state['build_info']['files'][] = str_replace("/$active_theme.info", '', $themes[$active_theme]->filename) . '/theme-settings.php';*/
}

/*function brilliance_settings_form_submit(&$form, $form_state) {
  $image_fid = $form_state['values']['slider_upload'];
  $image = file_load($image_fid);
  if (is_object($image)) {
    // Check to make sure that the file is set to be permanent.
    if ($image->status == 0) {
      // Update the status.
      $image->status = FILE_STATUS_PERMANENT;
      // Save the update.
      file_save($image);
      // Add a reference to prevent warnings.
      file_usage_add($image, 'brilliance', 'theme', 1);
    }
  }
}*/
