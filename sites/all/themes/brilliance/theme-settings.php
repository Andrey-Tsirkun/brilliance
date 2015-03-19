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
  $form['brilliance_settings']['brilliance_slider'] = array(
    '#type' => 'checkbox',
    '#title' => t('Brilliance Slider'),
    '#description' => t('Enable Brilliance Slider'),
    '#default_value' => (theme_get_setting('brilliance_slider', 'brilliance')),
  );
}
