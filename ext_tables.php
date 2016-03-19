<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Universal Search Bar');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_searchbar_domain_model_items', 'EXT:searchbar/Resources/Private/Language/locallang_csh_tx_searchbar_domain_model_items.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_searchbar_domain_model_items');
