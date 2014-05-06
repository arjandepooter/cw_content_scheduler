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
			'label' => 'LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_amount',
			'config' => array(
				'type' => 'input',
				'eval' => 'int',
			),
		),
		'tx_cwcontentscheduler_schedule_type' => array(
			'label' => 'LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_type',
			'config' => array(
				'type' => 'select',
				'default' => '',
				'items' => array(
					array('LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_type.empty', ''),
					array('LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_type.minutes', 'm'),
					array('LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_type.hours', 'h'),
					array('LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_type.days', 'd'),
					array('LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:tt_content.tx_cwcontentscheduler_schedule_type.weeks', 'w'),
				),
			),
		),
	), TRUE);

	// Add fields to Access palette
	t3lib_extMgm::addFieldsToPalette(
		'tt_content',
		'access',
		'tx_cwcontentscheduler_schedule_amount,tx_cwcontentscheduler_schedule_type',
		'after:endtime'
	);
}
?>