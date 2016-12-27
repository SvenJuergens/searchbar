<?php
defined('TYPO3_MODE') or die();

/***************
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'SvenJuergens.searchbar',
    'Pi1',
    'Universal SearchBar'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['searchbar_pi1'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['searchbar_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'searchbar_pi1',
    'FILE:EXT:searchbar/Configuration/FlexForms/flexform_searchbar.xml'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'searchbar',
    'Configuration/TypoScript',
    'Universal Search Bar'
);

