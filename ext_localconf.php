<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'SvenJuergens.' . $_EXTKEY,
    'Pi1',
    [
        'Items' => 'searchBarLink,searchBarFrontend,wrongFlexFormConfig',

    ],
    // non-cacheable actions
    [
        'Items' => 'searchBarLink',
    ]
);


// eID
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['searchbar'] =
    'EXT:searchbar/Classes/Eid/MainEid.php';


// Example for adding Additional Functions to Search Bar
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions']['Ip'] = [
    'title' => 'Show Current IP',
    'namespaceOfClass' => SvenJuergens\Searchbar\Example\Ip::class
];