<?php

require_once 'mygeneration.civix.php';
// phpcs:disable
use CRM_Mygeneration_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function mygeneration_civicrm_config(&$config) {
  _mygeneration_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function mygeneration_civicrm_install() {
  _mygeneration_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function mygeneration_civicrm_enable() {
  _mygeneration_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function mygeneration_civicrm_managed(&$entities) {
  $entities[] = [
    'module'  => 'au.com.agileware.mygeneration',
    'name' => 'calculatemygeneration',
    'entity' => 'Job',
    'update' => 'never',
    'params' => [
      'version' => 3,
      'name' => 'Calculate Generation for Contacts',
      'description' => 'Calculates the Generation for Contacts based on their Birth Date',
      'api_entity' => 'mygeneration',
      'api_action' => 'Calculatemygeneration',
      'run_frequency' => 'Daily',
    ],
  ];
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function mygeneration_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function mygeneration_civicrm_navigationMenu(&$menu) {
  _mygeneration_civix_insert_navigation_menu($menu, 'Administer', array(
    'label' => E::ts('My Generation'),
    'name' => 'mygeneration_settings',
    'url' => 'civicrm/admin/setting/mygeneration',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _mygeneration_civix_navigationMenu($menu);
}
