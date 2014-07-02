<?php
/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Leon de Rijke <leon@cmsworks.nl>, CMS Works BV
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
/**
 * Hook to display information about the Publication Repeat Interval in Web>Page module
 *
 * @package cw_content_scheduler
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_CwContentScheduler_Hooks_CmsLayout implements PageLayoutViewDrawItemHookInterface {

	/**
	 * Path to the locallang file
	 *
	 * @var string
	 */
	const LLPATH = 'LLL:EXT:cw_content_scheduler/Resources/Private/Language/locallang.xlf:';

	/**
	 * Preprocesses the preview rendering of a content element.
	 *
	 * @param  tx_cms_layout $parentObject   Calling parent object
	 * @param  boolean       $drawItem       Whether to draw the item using the default functionalities
	 * @param  string        $headerContent  Header content
	 * @param  string        $itemContent    Item content
	 * @param  array         $row            Record row of tt_content
	 * @return void
	 */
	public function preProcess(tx_cms_layout &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {
		if ($row['tx_cwcontentscheduler_schedule_type'] && $row['tx_cwcontentscheduler_schedule_amount']) {
			$headerContent = $this->getRepeatPreview($row) . $headerContent;
		}
	}

	/**
	 * Returns a preview of a content element with a Publication Repeat Interval set
	 *
	 * @param  array  $row Record row of tt_content
	 * @return string      Preview
	 */
	private function getRepeatPreview($row) {
		$preview = sprintf(
			$GLOBALS['LANG']->sL(self::LLPATH . 'preview', TRUE),
			$row['tx_cwcontentscheduler_schedule_amount'],
			lcfirst($this->getTranslatedType($row['tx_cwcontentscheduler_schedule_type']))
		);

		return "<div>" . $preview . "</div>";
	}

	/**
	 * Returns the human-readable Publication Repeat Interval unit
	 *
	 * @param  array  $type Untranslated type
	 * @return string       Translated type
	 */
	private function getTranslatedType($type) {
		return $GLOBALS['LANG']->sL(self::LLPATH . 'tt_content.tx_cwcontentscheduler_schedule_type.' . $type, TRUE);
	}

}
