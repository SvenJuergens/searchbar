<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

return array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items',		
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'type' => 'itemtype',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',
		),
		'iconfile'  => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('searchbar').'Resources/Public/Icons/icon_tx_searchbar_items.gif',
	),
	'interface' => array (
		'showRecordFieldList' => 'hidden,starttime,endtime,hotkey,searchurl,typoscript,itemtype,additionalfunctions'
	),
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'title' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.title',
			'config' => array (
				'type' => 'input',
				'eval' => 'required'
			)
		),
		'hotkey' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.hotkey',		
			'config' => array (
				'type' => 'input',	
				'size' => '5',	
				'eval' => 'required,unique',
			)
		),
		'hideinfe' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.hideinfe',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'glue' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.glue',
			'config' => array (
				'type' => 'input',
				'size' => '3',
				'eval' => 'required',
				'default' => '+'
			)
		),
		'searchurl' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.searchurl',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'typoscript' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.typoscript',		
			'config' => array (
				'type' => 'text',
				'wrap' => 'OFF',
				'cols' => '30',	
				'rows' => '5',
			)
		),
		'itemtype' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype',		
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
			'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.additionalfunctions',		
			'config' => array (
				'type' => 'select',
				'items' => array (),
				'itemsProcFunc' => 'tx_searchbar_functions_field->main',
				'size' => 1,	
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, searchurl'),
		'1' => array('showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, searchurl, typoscript'),
		'2' => array('showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, additionalfunctions')

	),
	'palettes' => array (
		'1' => array('showitem' => 'starttime, endtime'),
		'2' => array('showitem' => 'glue,hideinfe')
	)
);