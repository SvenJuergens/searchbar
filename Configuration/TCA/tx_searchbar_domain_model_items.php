<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'type' => 'itemtype',
        'dividers2tabs' => true,
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,hotkey,glue,searchurl,typoscript,itemtype,additionalfunctions,hideinfe,',
        'iconfile' => 'EXT:searchbar/Resources/Public/Icons/tx_searchbar_domain_model_items.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, title, hotkey, glue, searchurl, typoscript, itemtype, additionalfunctions, hideinfe',
    ],
    'types' => [
        '0' => ['showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, searchurl'],
        '1' => ['showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, searchurl, typoscript'],
        '2' => ['showitem' => 'hidden;;1;;1-1-1, title, itemtype, hotkey;;2;;1-1-1, additionalfunctions']
    ],
    'palettes' => [
        '1' => ['showitem' => 'starttime, endtime'],
        '2' => ['showitem' => 'glue,hideinfe']
    ],
    'columns' => [

        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0
            ],
        ],

        'title' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'hotkey' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.hotkey',
            'config' => [
                'type' => 'input',
                'size' => '5',
                'eval' => 'required,unique',
            ]
        ],
        'glue' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.glue',
            'config' => [
                'type' => 'input',
                'size' => 3,
                'eval' => 'trim,required',
                'default' => '+'
            ],
        ],
        'searchurl' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.searchurl',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'typoscript' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.typoscript',
            'config' => [
                'type' => 'text',
                'wrap' => 'off',
                'cols' => '30',
                'rows' => '5',
            ]
        ],
        'itemtype' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.itemtype',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype.I.0', '0'],
                    ['LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype.I.1', '1'],
                    ['LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_items.itemtype.I.2', '2'],
                ],
                'size' => 1,
                'maxitems' => 1,
            ]
        ],
        'additionalfunctions' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.additionalfunctions',
            'config' => [
                'type' => 'select',
                'items' => [],
                'itemsProcFunc' => 'SvenJuergens\\Searchbar\\Utility\\AdditionalFunctionsField->main',
                'size' => 1,
                'maxitems' => 1,
            ]
        ],
        'hideinfe' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:searchbar/Resources/Private/Language/locallang_db.xlf:tx_searchbar_domain_model_items.hideinfe',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],

    ],
];