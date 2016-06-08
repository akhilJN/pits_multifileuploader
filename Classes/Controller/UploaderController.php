<?php
namespace PMFU\PitsMultifileuploader\Controller;

use PMFU\PitsMultifileuploader\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Extbase\Reflection\ClassReflection;

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
 * ReferenceController
 */
class UploaderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

  // public function __construct(){
  //   $this->Model = new \PITS\Pitscategorygrids\Domain\Model\Catagorygrids();
  // }
	// public function showAction() {
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump("dfdfgdfsdf");
  //   die;
  // }
  // public function uploadAction(){
  //   if(isset($_FILES['image'])){
  //     $errors= array();
  //     $file_name = $_FILES['image']['name'];
  //     $file_size =$_FILES['image']['size'];
  //     $file_tmp =$_FILES['image']['tmp_name'];
  //     $file_type=$_FILES['image']['type'];
  //     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
  //   } else{
  //     $file_name = "no";
  //     $file_size = "no";
  //     $file_tmp = "no";
  //     $file_type= "no";
  //     $file_ext= "no";
  //   }
  //   $uploadDirectory = "http://192.168.0.204/pwc/typo3v7/uploads/pics";
  //   $base_url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'];
  //   $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory,$name));
  //   $path = parse_url($target, PHP_URL_PATH);
  //   $target = stripcslashes($_SERVER['DOCUMENT_ROOT'] . $path);
	//
	//
  //   if(empty($errors)==true){
  //        move_uploaded_file($file_tmp,$target.$file_name);
  //        $this->persistSysTable($target,$file_name);
  //        echo "Success";
  //     }else{
  //        print_r("nooooooooo");
  //     }
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($target);
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($file_name);
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($file_size);
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($file_tmp);
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($file_type);
  //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($file_ext);
  //   die;
  // }

	/**
	 * uploaderRepository
	 *
	 * @var \PMFU\PitsMultifileuploader\Domain\Repository\UploaderRepository
	 * @inject
	 */
	protected $exampleRepository;

	/**
	 * action hello
	 *
	 * @return string
	 */
	public function helloAction() {
		return 'Hello World!';
	}

	/**
	 * Action greeting
	 *
	 * @param string $name
	 * @return string
	 */
	public function greetingAction($name) {
		$this->view->assign('name', $name);
		$this->view->assign('layoutName', 'Funny');
	}

	/**
	 * Action list
	 *
	 * @return void
	 */
	public function listAction() {
		$requestScheme = $_SERVER['REQUEST_SCHEME'];
    $host = $_SERVER['HTTP_HOST'];
    $path = substr($_SERVER['CWD'],0,-6);
    $baseurl = $requestScheme.'://'.$host.$path;

		$examples = $this->exampleRepository->findAll();
		$this->view->assign('examples', $examples);
		$this->view->assign('baseurl', $baseurl);
	}

	/**
	 * Action show
	 *
	 * @param \PMFU\PitsMultifileuploader\Domain\Model\Uploader $example
	 */
	public function showAction(\PMFU\PitsMultifileuploader\Domain\Model\Uploader $example) {
		$this->view->assign('example', $example);
	}

	/**
	 * Action show
	 *
	 * @param \PMFU\PitsMultifileuploader\Domain\Model\Uploader $example
	 */
	public function editAction(\PMFU\PitsMultifileuploader\Domain\Model\Uploader $example) {
		$this->view->assign('example', $example);
	}

	/**
	 * action new
	 */
	public function newAction() {
		$requestScheme = $_SERVER['REQUEST_SCHEME'];
    $host = $_SERVER['HTTP_HOST'];
    $path = substr($_SERVER['CWD'],0,-6);
    $baseurl = $requestScheme.'://'.$host.$path;


		$newExample = new \PMFU\PitsMultifileuploader\Domain\Model\Uploader();
		$this->view->assign('newExample', $newExample);
		$this->view->assign('baseurl', $baseurl);
	}

	/**
	 * Set TypeConverter option for image upload
	 */
	public function initializeCreateAction() {
		$this->setTypeConverterConfigurationForImageUpload('newExample');
	}

	/**
	 * action create
	 *
	 * @param \PMFU\PitsMultifileuploader\Domain\Model\Uploader $newExample
	 */
	public function createAction(\PMFU\PitsMultifileuploader\Domain\Model\Uploader $newExampl) {
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newExampl);
		die;
		$this->contentObj = $this->configurationManager->getContentObject();
		$ttContentUid = $this->contentObj->data['uid'];
    $pageid = intval($GLOBALS['TSFE']->id);
		$originalFile = $newExample->getImage()->getOriginalResource()->getOriginalFile();
		$originalFileArray = (array)$originalFile;
		$originalFileArrayKey = array_keys($originalFileArray);
		$fileUid = $originalFileArray[$originalFileArrayKey[4]]['uid'];

		$flag = $this->exampleRepository->updatePageIdIFile($fileUid,$pageid);
		if($flag){
			$this->exampleRepository->addSysFileReference($fileUid,$pageid,$ttContentUid);
		}else{
			die;
		}

		$this->addFlashMessage('Your new Example was created.');
		$this->redirect('list');
	}

	/**
	 * Set TypeConverter option for image upload
	 */
	public function initializeUpdateAction() {
		$this->setTypeConverterConfigurationForImageUpload('example');
	}

	/**
	 * action Update
	 *
	 * @param \PMFU\PitsMultifileuploader\Domain\Model\Uploader $example
	 */
	public function updateAction(\PMFU\PitsMultifileuploader\Domain\Model\Uploader $example) {
		$this->exampleRepository->update($example);
		$this->addFlashMessage('Your new Example was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \PMFU\PitsMultifileuploader\Domain\Model\Uploader $example
	 * @ignoreValidation $example
	 */
	public function deleteAction(\PMFU\PitsMultifileuploader\Domain\Model\Uploader $example) {
		$this->exampleRepository->remove($example);
		$this->addFlashMessage('Your new Example was removed.');
		$this->redirect('list');
	}

	/**
	 *
	 */
	protected function setTypeConverterConfigurationForImageUpload($argumentName) {
		$uploadConfiguration = array(
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/',
		);
		/** @var PropertyMappingConfiguration $newExampleConfiguration */
		$newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
		$newExampleConfiguration->forProperty('image')
			->setTypeConverterOptions(
				'PMFU\\PitsMultifileuploader\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfiguration
			);
		$newExampleConfiguration->forProperty('imageCollection.0')
			->setTypeConverterOptions(
				'PMFU\\PitsMultifileuploader\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfiguration
			);
	}

}
