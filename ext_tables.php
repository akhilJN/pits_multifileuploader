<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'PMFU.' . $_EXTKEY,
	'Multifileuploader',
	'multifileuploader'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'PITS Multi File Uploader');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pitsmultifileuploader_domain_model_uploader', 'EXT:pits_multifileuploader/Resources/Private/Language/locallang_csh_tx_pitsmultifileuploader_domain_model_uploader.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pitsmultifileuploader_domain_model_uploader');


// $pluginSignature = 'pits_multifileuploader';
// $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:pits_multifileuploader/Configuration/FlexForms/flexform_pmfu.xml');

// $TCA['tt_content']['types']['list']['subtypes_addlist']['powermail_pi1'] = 'pi_flexform';
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
//     'powermail_pi1',
// );

$pluginSignature = str_replace('_','',$_EXTKEY).'_multifileuploader';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pmfu.xml');