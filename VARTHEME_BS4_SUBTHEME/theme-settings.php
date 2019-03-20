<?php
/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for Bootstrap Barrio based themes when admin theme is not.
 *
 * @see ./includes/settings.inc
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function VARTHEME_BS4_SUBTHEME_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {

  // General "alters" use a form id. Settings should not be set here. The only
  // thing useful about this is if you need to alter the form for the running
  // theme and *not* the theme setting.
  // @see http://drupal.org/node/943212
  if (isset($form_id)) {
    return;
  }

  $form['email_logo'] = array(
    '#type'     => 'details',
    '#title'    => t('Email Logo'),
    '#open' => false
  );
  $form['email_logo']['email_logo_default'] = array(
      "#type" => "checkbox",
      '#title'    => t('Use the logo supplied by the theme'),
      "#default_value" => theme_get_setting('email_logo_default'),
  );

  $form['email_logo']['email_logo_settings'] = array(
      "#type" => "container",
      '#states' => array(
        "invisible" => array(
          'input[name="email_logo_default"]' => array(
            "checked" => TRUE
          )
        )
      )
  );

  $form['email_logo']['email_logo_settings']["email_logo_path"] = array(
      "#type" => "textfield",
      "#title" => "Path to custom logo",
      "#default_value" => theme_get_setting('email_logo_path'),
      "#description" => t("Examples: <code>@external-file</code>", array("@external-file"=> "http://www.example.com/logo.png"))
  );

  $form['email_logo']['email_logo_settings']["email_logo_upload"] = array(
      '#type'     => 'managed_file',
      "#title"    => t("Upload logo image"),
      "#description" => t("If you don't have direct file access to the server, use this field to upload your logo."),
      '#required' => FALSE,
      '#upload_location' => file_default_scheme() . '://theme/email_logo/',
      '#default_value' => theme_get_setting('email_logo_upload'),
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
  );
  //Replace Barrio setting options with subtheme ones.
  $form['components']['navbar']['bootstrap_barrio_navbar_top_background']['#options'] = array(
      'bg-primary' => t('Primary'),
      'bg-secondary' => t('Secondary'),
      'bg-light' => t('Light'),
      'bg-dark' => t('Dark'),
      'bg-white' => t('White'),
      'bg-transparent' => t('Transparent'),
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_background']['#options'] = array(
      'bg-primary' => t('Primary'),
      'bg-secondary' => t('Secondary'),
      'bg-light' => t('Light'),
      'bg-dark' => t('Dark'),
      'bg-white' => t('White'),
      'bg-transparent' => t('Transparent'),
  );
}
