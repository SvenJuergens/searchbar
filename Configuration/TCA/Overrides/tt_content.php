<?php
defined('TYPO3_MODE') or die();

/***************
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'SvenJuergens.searchbar',
	'Pi1',
	'Add a Browser Search Bar'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['searchbar_pi1'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['searchbar_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('searchbar_pi1',
    'FILE:EXT:searchbar/Configuration/FlexForms/flexform_searchbar.xml');

// TypoScript
#\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('news', 'Configuration/TypoScript', 'News');
