<?php
/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Arjan de Pooter <arjan@cmsworks.nl>, CMS Works BV
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

/**
 *
 *
 * @package cw_content_scheduler
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_CwContentScheduler_Hooks_EnableColumnsHook {

	/**
	 * Query template
	 *
	 * @var string
	 */
	protected $queryTemplate = 'EXT:cw_content_scheduler/Resources/Private/Queries/ScheduledQuery.sql';

	/**
	 * Process the 'scheduled' enableColumn
	 *
	 * @param  array            $params Array with the needed parameters
	 * @param  t3lib_pageSelect $pObj   The parent object
	 * @return string The WHERE-clause to add
	 */
	public function process($params, $pObj) {
		if($params['ctrl']['enablecolumns']['scheduled']) {
			list($starttime, $endtime, $scheduleAmount, $scheduleType) = explode(',', $params['ctrl']['enablecolumns']['scheduled']);

			$queryTemplate = file_get_contents(t3lib_div::getFileAbsFileName($this->queryTemplate));
			return sprintf($queryTemplate, $params['table'], $starttime, $endtime, $scheduleAmount, $scheduleType, $GLOBALS['SIM_ACCESS_TIME']);
		}

		return '';
	}
}
?>