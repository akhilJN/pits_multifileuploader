<?php
namespace PMFU\PitsMultifileuploader\Domain\Model;

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
 * Class FileReference
 */
class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference {

	/**
	 * Uid of a sys_file
	 *
	 * @var integer
	 */
	protected $originalFileIdentifier;

	/**
  	* We need this property so that the Extbase persistence can properly persist the object
    *
    * @var integer
    */
  protected $uidLocal;

  /**
    * @param \TYPO3\CMS\Core\Resource\FileReference $originalResource
    */
  public function setOriginalResource(\TYPO3\CMS\Core\Resource\FileReference $originalResource) {
      $this->originalResource = $originalResource;
      $this->uidLocal = (int)$originalResource->getUid();
  }


	/**
	 * @param \TYPO3\CMS\Core\Resource\File $falFile
	 */
	public function setFile(\TYPO3\CMS\Core\Resource\File $falFile) {
		$this->originalFileIdentifier = (int)$falFile->getUid();
	}


}
