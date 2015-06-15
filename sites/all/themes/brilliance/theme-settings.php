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
}
