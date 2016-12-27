<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'SvenJuergens.' . $_EXTKEY,
    'Pi1',
    array(
        'Items' => 'searchbarLink,list, show',

    ),
    // non-cacheable actions
    array(
        'Items' => 'searchbarLink',
    )
);


// eID
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['searchbar'] =
    'EXT:searchbar/Classes/Eid/MainEid.php';


// Example for adding Additional Functions to Search Bar
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions']['Ip'] = array(
    'title' => 'Show Current IP',
    'namespaceOfClass' => SvenJuergens\Searchbar\Example\Ip::class
);