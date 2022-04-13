<?php

use CRM_Mygeneration_ExtensionUtil as E;

/**
 * Mygeneration.Calculatemygeneration API
 *
 * @return array
 *   API result descriptor
 *
 * @throws \CRM_Core_Exception
 *
 * @see civicrm_api3_create_success
 */
function civicrm_api3_mygeneration_Calculatemygeneration() {
  try {

    $generation_field_id = Civi::settings()->get('generation_fieldid');

    if (!is_numeric($generation_field_id)) {
      throw new CRM_Core_Exception('Generation Field ID is not set.');
    }

    $generation_builder = Civi::settings()->get('generation_builder');
    $generation_boomer  = Civi::settings()->get('generation_boomer');
    $generation_genx    = Civi::settings()->get('generation_genx');
    $generation_geny    = Civi::settings()->get('generation_geny');
    $generation_genz    = Civi::settings()->get('generation_genz');

    if (!is_numeric($generation_builder)) {
      throw new CRM_Core_Exception('Builder Generation Option Value is not set.');
    }

    if (!is_numeric($generation_boomer)) {
      throw new CRM_Core_Exception('Boomer Generation Option Value is not set.');
    }

    if (!is_numeric($generation_genx)) {
      throw new CRM_Core_Exception('Gen X Generation Option Value is not set.');
    }

    if (!is_numeric($generation_geny)) {
      throw new CRM_Core_Exception('Gen Y Generation Option Value is not set.');
    }

    if (!is_numeric($generation_genz)) {
      throw new CRM_Core_Exception('Gen Z Generation Option Value is not set.');
    }

    $generation_field = \Civi\Api4\CustomField::get(FALSE)
                                              ->addWhere('id', '=', $generation_field_id)
                                              ->addSelect('custom_group_id.table_name', 'column_name')
                                              ->execute()
                                              ->first();

    if (!$generation_field) {
      throw new CRM_Core_Exception('Generation Field ID does not exist.');
    }

    $generation_field_table  = $generation_field['custom_group_id.table_name'];
    $generation_field_column = $generation_field['column_name'];

    CRM_Core_DAO::executeQuery("CREATE TEMPORARY TABLE `tmp_" . $generation_field_table . "` AS SELECT `civicrm_contact`.`id`,`civicrm_contact`.`birth_date` FROM `civicrm_contact` WHERE `civicrm_contact`.`is_deleted`=0");

    // Calculate the Builder Generation

    CRM_Core_DAO::executeQuery("INSERT INTO `" . $generation_field_table . "` (`entity_id`, `" . $generation_field_column . "`)
    SELECT `tmp_" . $generation_field_table . "`.`id`,%1 FROM `tmp_" . $generation_field_table . "` WHERE `tmp_" . $generation_field_table . "`.`birth_date` < '1946-01-01'
  ON DUPLICATE KEY UPDATE `" . $generation_field_column . "`=%1", [
      1 => [$generation_builder, 'Integer'],
    ]);

    // Calculate the Boomer Generation

    CRM_Core_DAO::executeQuery("INSERT INTO `" . $generation_field_table . "` (`entity_id`, `" . $generation_field_column . "`)
  SELECT `tmp_" . $generation_field_table . "`.`id`,%1 FROM `tmp_" . $generation_field_table . "` WHERE `tmp_" . $generation_field_table . "`.`birth_date` >= '1946-01-01' AND `tmp_" . $generation_field_table . "`.`birth_date` < '1963-01-01'
  ON DUPLICATE KEY UPDATE `" . $generation_field_column . "`=%1", [
      1 => [$generation_boomer, 'Integer'],
    ]);

    // Calculate the Gen X Generation

    CRM_Core_DAO::executeQuery("INSERT INTO `" . $generation_field_table . "` (`entity_id`, `" . $generation_field_column . "`)
  SELECT `tmp_" . $generation_field_table . "`.`id`,%1 FROM `tmp_" . $generation_field_table . "` WHERE `tmp_" . $generation_field_table . "`.`birth_date` >= '1963-01-01' AND `tmp_" . $generation_field_table . "`.`birth_date` < '1981-01-01'
  ON DUPLICATE KEY UPDATE `" . $generation_field_column . "`=%1", [
      1 => [$generation_genx, 'Integer'],
    ]);

    // Calculate the Gen Y Generation

    CRM_Core_DAO::executeQuery("INSERT INTO `" . $generation_field_table . "` (`entity_id`, `" . $generation_field_column . "`)
   SELECT `tmp_" . $generation_field_table . "`.`id`,%1 FROM `tmp_" . $generation_field_table . "` WHERE `tmp_" . $generation_field_table . "`.`birth_date` >= '1981-01-01' AND `tmp_" . $generation_field_table . "`.`birth_date` < '2000-01-01'
  ON DUPLICATE KEY UPDATE `" . $generation_field_column . "`=%1", [
      1 => [$generation_geny, 'Integer'],
    ]);

    // Calculate the Gen Z Generation

    CRM_Core_DAO::executeQuery("INSERT INTO `" . $generation_field_table . "` (`entity_id`, `" . $generation_field_column . "`)
   SELECT `tmp_" . $generation_field_table . "`.`id`,%1 FROM `tmp_" . $generation_field_table . "` WHERE `tmp_" . $generation_field_table . "`.`birth_date` >= '2000-01-01'
  ON DUPLICATE KEY UPDATE `" . $generation_field_column . "`=%1", [
      1 => [$generation_genz, 'Integer'],
    ]);

    return civicrm_api3_create_success(TRUE, $params, 'mygeneration', 'calculatemygeneration');
  }
  catch (Exception $e) {
    throw new CRM_Core_Exception('Error calculating Generation for Contacts. Error: ' . $e->getMessage());
  }
}
