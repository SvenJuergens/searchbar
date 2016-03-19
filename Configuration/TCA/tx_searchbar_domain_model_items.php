<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'type' => 'itemtype',
		'dividers2tabs' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,hotkey,glue,searchurl,typoscript,itemtype,additionalfunctions,hideinfe,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('searchbar') . 'Resources/Public/Icons/tx_searchbar_domain_model_items.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, title, hotkey, glue, searchurl, typoscript, itemtype, additionalfunctions, hideinfe',
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, searchurl'),
		'1' => array('showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, searchurl, typoscript'),
		'2' => array('showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, additionalfunctions')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime'),
		'2' => array('showitem' => 'glue,hideinfe')
	),
	'columns' => array(

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'hotkey' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.hotkey',
			'config' => array (
				'type' => 'input',
				'size' => '5',
				'eval' => 'required,unique',
			)
		),
		'glue' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.glue',
			'config' => array(
				'type' => 'input',
				'size' => 3,
				'eval' => 'trim,required',
				'default' => '+'
			),
		),
		'searchurl' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.searchurl',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'typoscript' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.typoscript',
			'config' => array (
				'type' => 'text',
				'wrap' => 'off',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'itemtype' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.itemtype',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype.I.0', '0'),
					array('LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype.I.1', '1'),
					array('LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype.I.2', '2'),
				),
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'additionalfunctions' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.additionalfunctions',
			'config' => array (
				'type' => 'select',
				'items' => array (),
				'itemsProcFunc' => 'SvenJuergens\\Searchbar\\Utility\\AdditionalFunctionsField->main',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'hideinfe' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.hideinfe',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),

	),
);