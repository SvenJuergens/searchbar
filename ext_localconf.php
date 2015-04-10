<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_searchbar_items=1
');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, 'pi1/class.tx_searchbar_pi1.php', '_pi1', 'list_type', 1);

// eID
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['searchbar'] = 
	'EXT:searchbar/Classes/Eid/MainEid.php';


// Example for adding Additional Functions to Search Bar
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions']['tx_searchbar_ip'] = array(
	'title' => 'Show Current IP',
	'filePath' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/class.tx_searchbar_ip.php'
	);
