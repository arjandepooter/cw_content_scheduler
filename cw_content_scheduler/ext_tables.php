<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if(TRUE || $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cw_content_scheduler']['setup']['apply_to_ttcontent']) {
	t3lib_div::loadTCA('tt_content');

	// Replace starttime and endtime with a scheduled enableField
	$GLOBALS['TCA']['tt_content']['ctrl']['enablecolumns']['scheduled'] = 'starttime,endtime,tx_cwcontentscheduler_schedule_amount,tx_cwcontentscheduler_schedule_type';
	unset($GLOBALS['TCA']['tt_content']['ctrl']['enablecolumns']['starttime']);
	unset($GLOBALS['TCA']['tt_content']['ctrl']['enablecolumns']['endtime']);

	// Add schedulerfield to tt_content TCA
	t3lib_extMgm::addTCAcolumns('tt_content', array(
		'tx_cwcontentscheduler_schedule_amount' => array(
			'label' => 'Scheduler',
			'config' => array(
				'type' => 'input',
				'eval' => 'int',
			),
		),
		'tx_cwcontentscheduler_schedule_type' => array(
			'label' => 'Scheduler',
			'config' => array(
				'type' => 'select',
				'default' => '',
				'items' => array(
					array('-------', ''),
					array('minutes', 'm'),
					array('hours', 'h'),
					array('days', 'd'),
					array('weeks', 'w'),
				),
			),
		),
	), TRUE);

	// Add field to TCA types
	t3lib_extMgm::addToAllTCAtypes('tt_content', 'tx_cwcontentscheduler_schedule_amount,tx_cwcontentscheduler_schedule_type', '', 'after:endtime');
}
?>