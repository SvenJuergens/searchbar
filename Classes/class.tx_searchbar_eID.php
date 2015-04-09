<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;

define(searchbar_TYPE_NORMAL, 0);
define(searchbar_TYPE_TYPOSCRIPT, 1);
define(searchbar_TYPE_FUNCTIONS, 2);

class tx_searchbar_eID {

	public $q;
	public $table;
	public $enableFields;

	public $extensionConfiguration;

	public function init() {

		TYPO3\CMS\Frontend\Utility\EidUtility::connectDB();
		TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();


		$this->extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['searchbar']);

		$this->q = htmlspecialchars(GeneralUtility::_GET('q'));

		if (empty($this->q)) {
			$value = GeneralUtility::_GET('tx_searchbarfrontend_pi1');
			if (is_array($value)) {
				$this->q = htmlspecialchars($value['q']);
			}
		}

		$this->q = GeneralUtility::trimExplode(' ', $this->q, 1);

		$this->table = 'tx_searchbar_items';
		$this->enableFields = BackendUtility::BEenableFields( $this->table) . BackendUtility::deleteClause( $this->table);

		if (strtolower($this->q[0]) == 'help') {
			$this->showHelp();
			exit;
		}

		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['eID_afterInit'])) {
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['eID_afterInit'] as $userFunc) {
				$params = array(
					'pObj' => &$this
				);
				GeneralUtility::callUserFunction($userFunc, $params, $this);
			}
		}

	}


	public function main() {

		// get record
		$row = $this->getRecord($this->q[0]);

		if(empty($row) && $this->extensionConfiguration['useDefaultHotKey'] == 1 ){
			$temp = array( htmlspecialchars( $this->extensionConfiguration['defaultHotKey'] ) );
			$this->q = array_merge( $temp, $this->q );
			$row = $this->getRecord($this->q[0]);
		}

		if (empty($row)) {
			$this->showHelp();
		}

		$this->getRedirect($row['0']);

	}

	public function getRedirect($row) {

		unset($this->q['0']);
		$urlPart = '';

		if ($row['itemtype'] == searchbar_TYPE_TYPOSCRIPT) {
			$urlPart = $this->getTypoScriptCode($row, $this->q);
		} elseif ($row['itemtype'] == searchbar_TYPE_NORMAL) {
			$urlPart = implode(
				$row['glue'],
				$this->q
			);
		}
		if (strpos($row['searchurl'], '###SEARCHWORD##') !== FALSE) {
			$url = str_replace(
				'###SEARCHWORD###',
				$urlPart,
				$row['searchurl']
			);
		} else {
			$url = $row['searchurl'] . $urlPart;

		}

		if ($row['itemtype'] == searchbar_TYPE_FUNCTIONS) {
			$file = '';
			$file = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions'][$row['additionalfunctions']]['filePath'];

			if (is_file($file)) {
				require_once $file;
				$userfile = GeneralUtility::makeInstance($row['additionalfunctions']);
				$url = $userfile->execute($row, $this->q);
			}

		}
		TYPO3\CMS\Core\Utility\HttpUtility::redirect( $url );
	}

	public function getTypoScriptCode(&$row) {
		$typoScriptCode = str_replace('###INPUT###', implode($row['glue'], $this->q), $row['typoscript']);

		$TSparserObject = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\Parser\\TypoScriptParser');
		$TSparserObject->parse($typoScriptCode);

		$cObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
		$cObj->start(array(), '');

		$tsfeClassName = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController');
		$GLOBALS['TSFE'] = new $tsfeClassName( $GLOBALS['TYPO3_CONF_VARS'], 0, '');
		return $cObj->cObjGet($TSparserObject->setup);
	}

	public function getRecord($hotkey) {
		$arrRow = array();
		$arrRow = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'title, hotkey, glue, searchurl, typoscript, itemtype, additionalfunctions',
			$this->table,
			'hotkey=' . $GLOBALS['TYPO3_DB']->fullQuoteStr(htmlspecialchars($hotkey), $this->table) .
				$this->enableFields,
			'',
			'',
			'1'
		);

		return $arrRow;
	}

	public function showHelp() {
		$arrItems = array();

		if ($this->extensionConfiguration['showHelp'] == 1) {
			$arrItems = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'*',
				$this->table,
				'1=1' . $this->enableFields,
				'',
				''
			);
			if (!empty ($arrItems)) {
				echo $this->buildingList($arrItems);
			} else {
				echo 'No Entries';
			}
			exit;
		} else {
			echo 'access forbidden';
			exit;
		}
	}

	public function buildingList($arrItems) {

		$template = '';
		$templateCode = '';

		$templateCode = $this->getHtmlTemplate($this->extensionConfiguration['helpTemplateFile']);

		if (empty($templateCode)) {
			return 'Template not found, please check the Extension settings in ExtensionManager';
		}

		$templateSubpart = TYPO3\CMS\Core\Html\HtmlParser::getSubpart($templateCode, '###ROW###');

		$alt = 0;
		$entries = array();

		foreach ($arrItems as $key => $item) {
			$markerArray = array(
				'###CLASS###' => ($alt % 2) ? 'even' : 'odd',
				'###TITLE###' => htmlspecialchars($item['title']),
				'###HOTKEY###' => htmlspecialchars($item['hotkey']),
			);
			$entries[] = TYPO3\CMS\Core\Html\HtmlParser::substituteMarkerArray($templateSubpart, $markerArray);
			$alt++;
		}

		$template = TYPO3\CMS\Core\Html\HtmlParser::getSubpart($templateCode, '###HELPLIST###');
		return TYPO3\CMS\Core\Html\HtmlParser::substituteSubpart($template, '###ROW###', implode('', $entries));

	}

	function getHtmlTemplate($filename) {

		if (substr($filename, 0, 4) != 'EXT:') {
			$filename = GeneralUtility::resolveBackPath($this->backPath . $filename);
		} else {
			$filename = GeneralUtility::getFileAbsFileName($filename, true, true);
		}
		return GeneralUtility::getURL($filename);
	}


}

// Make instance:
$SOBE = GeneralUtility::makeInstance('tx_searchbar_eID');
$SOBE->init();
$SOBE->main();
