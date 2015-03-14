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
  $form['brilliance_settings']['header_state'] = array(
    '#type' => 'radios',
    '#title' => t('Header state'),
    '#description' => t('Choose header state.'),
    '#options' => array(
      'default_header' => t('Default header'),
      'sticky_header' => t('Sticky header'),
    ),
    '#default_value' => theme_get_setting('default_header'),
  );
}