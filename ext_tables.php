<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_searchbar_domain_model_items',
    'EXT:searchbar/Resources/Private/Language/locallang_csh_tx_searchbar_domain_model_items.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_searchbar_domain_model_items'
);
