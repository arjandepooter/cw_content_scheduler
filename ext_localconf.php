<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TYPO3_CONF_VARS['EXTCONF']['cw_content_scheduler']['setup'] = unserialize($_EXTCONF);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_page.php']['addEnableColumns'][] = 'EXT:cw_content_scheduler/Classes/Hooks/EnableColumnsHook.php:Tx_CwContentScheduler_Hooks_EnableColumnsHook->process';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem'][$_EXTKEY] = 'EXT:cw_content_scheduler/Classes/Hooks/CmsLayout.php:Tx_CwContentScheduler_Hooks_CmsLayout';

?>