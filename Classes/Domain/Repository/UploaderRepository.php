<?php
namespace PMFU\PitsMultifileuploader\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Akhil Jayan <akhil.jn@pitsolutions.com>, PIT Solutions Pvt. Ltd.
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
 ***************************************************************/

/**
 * The repository for Uploaders
 */
class UploaderRepository extends \TYPO3\CMS\Extbase\Persistence\Repository{
  protected $fileTable = 'sys_file';

  protected $referenceTable = 'sys_file_reference';

  public function updatePageIdIFile($fileUid,$pageid){
    $query = $this->createQuery();
    $rawSql1 = "SELECT pid FROM $this->fileTable WHERE uid=".$fileUid.";";
		$row = $GLOBALS['TYPO3_DB']->sql_query($rawSql1)->fetch_assoc();

		$rawSql2 = "UPDATE $this->fileTable SET pid = ".$pageid." WHERE uid = ".$fileUid.";";
		$GLOBALS['TYPO3_DB']->sql_query($rawSql2);

    return true;
  }

  public function addSysFileReference($fileUid,$pageid,$ttContentUid){
    $data = array();
		$data['sys_file_reference']['NEW1234'] = array(
		    'table_local' => 'sys_file',
		    'uid_local'   => $fileUid,
		    'tablenames'  => 'tt_content',
		    'uid_foreign' => $ttContentUid, // uid of your content record
		    'fieldname'   => 'image',
		    'pid'         => $pageid, // page id of content record
		);
		$data['tt_content'][$ttContentUid] = array(
		    'image' => 'NEW1234' // changed automatically
		);

		/** @var \TYPO3\CMS\Core\DataHandling\DataHandler $tce */
		$tce = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler'); // create TCE instance
		$tce->start($data, array());
		$tce->process_datamap();
		if ($tce->errorLog) {
		} else {
		    $content .= 'image changed';
		}

  }
}
