<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PMFU.' . $_EXTKEY,
	'Multifileuploader',
	array(
		'Uploader' => 'list, show, new, create, edit, update, delete',

	),
	// non-cacheable actions
	array(
		'Uploader' => 'list, show, new, create, edit, update, delete',

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('PMFU\\PitsMultifileuploader\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('PMFU\\PitsMultifileuploader\\Property\\TypeConverter\\ObjectStorageConverter');
