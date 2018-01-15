<?php
/**
 * @package	JE Ajax Contact Module !
 * @version	1.1.0
 * @author	jooexpert.com
 * @copyright	Copyright (C) 2018 jooexpert. All rights reserved.
 * @license	jooexpert
 */

defined('_JEXEC') or die;

// Include the helper.
require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
require JModuleHelper::getLayoutPath('mod_je_ajax_contact', $params->get('layout', 'default'));

?>




