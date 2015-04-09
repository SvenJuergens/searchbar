<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Sven Jürgens <t3@blue-side.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib . 'class.tslib_pibase.php');


/**
 * Plugin 'Add a Browser Search Bar' for the 'searchbar' extension.
 *
 * @author    Sven Jürgens <t3@blue-side.de>
 * @package    TYPO3
 * @subpackage    tx_searchbar
 */
class tx_searchbar_pi1 extends tslib_pibase {
    public $prefixId = 'tx_searchbar_pi1'; // Same as class name
    public $scriptRelPath = 'pi1/class.tx_searchbar_pi1.php'; // Path to this script relative to the extension dir.
    public $extKey = 'searchbar'; // The extension key.
    public $pi_checkCHash = true;

    public $templateCode;
    public $linkForOpenSearch;

    /**
     * The main method of the PlugIn
     *
     * @param    string        $content: The PlugIn content
     * @param    array        $conf: The PlugIn configuration
     * @return    The content that is displayed on the website
     */
    function main($content, $conf) {
        $this->conf = $conf;
        $this->pi_setPiVarDefaults();
        $this->pi_loadLL();
        $this->init();

        if (!is_null(t3lib_div::_GP('type')) && (t3lib_div::_GP('type') == $this->conf['typeNum'])) {
            $content = $this->getSearch();
            header('Content-type:application/xml;');
            echo $content;
            exit;
        } else {
            $this->addHeaderPart();
            $content = $this->buildSearchProviderLink();
            $content = $this->pi_wrapInBaseClass($content);
        }
        return $content;

    }

    public function init() {

        if (isset($this->conf['typeNum']) && !empty($this->conf['typeNum'])) {
            $this->conf['typeNum'] = intval($this->conf['typeNum']);
        }

        $this->linkForOpenSearch = $this->getOpenSearchURL();
        if(isset($this->cObj->data['pi_flexform'])){
            $this->cObj->readFlexformIntoConf($this->cObj->data['pi_flexform'], $this->conf);
        }else{
            $this->getPluginConfig();
        }

        if(empty($this->conf['contentProviderText'])){
            $this->conf['contentProviderText'] = htmlspecialchars($this->pi_getLL('contentProviderText'));
        }else{
            $this->conf['contentProviderText'] = htmlspecialchars($this->conf['contentProviderText']);
        }

        if(empty($this->conf['linkname'])){
            $this->conf['linkname'] = $this->pi_getLL('searchproviderlinktext','add Searchprovider');
        }else{
            $this->conf['linkname'] = htmlspecialchars($this->conf['linkname']);
        }
        $this->templateCode = $this->cObj->fileResource($this->conf['templateFile']);

        if (empty($this->templateCode)) {
            $this->templateCode = $this->cObj->fileResource('EXT:' . $this->extKey . '/Resources/templates/template.html');
        }

    }


    public function addHeaderPart() {
        $link =  '<link rel="search" type="application/opensearchdescription+xml"'
            . ' href="' . $this->linkForOpenSearch . '"'
            . ' title="' .htmlspecialchars($this->conf['pluginDescription']) . '" />';
        $GLOBALS['TSFE']->additionalHeaderData[$this->extKey] = $link;
    }

    public function buildSearchProviderLink() {
         if( !isset($this->conf['typeNum']) || empty($this->conf['typeNum']) ){
            return  $this->pi_getLL('missingtypoScript','Missing TypoScript Configuration');
        }
        $templateSubpart = $this->cObj->getSubpart($this->templateCode, '###ADDSEARCHPROVIDER###');

        $markerArray = array(
            '###SITEURL###' => $this->cObj->typolink_URL(array('parameter' => $GLOBALS['TSFE']->id)),
            '###SEARCHPROVIDERLINK###' => $this->linkForOpenSearch,
            '###SEARCHPROVIDERLINKTEXT###' => $this->conf['linkname']
        );

        $link = $this->cObj->substituteMarkerArray($templateSubpart, $markerArray);
        $content = str_replace('###LINK###', $link, $this->conf['contentProviderText']);
        return $content;
    }

    public function getOpenSearchURL() {
        $conf = array(
            'parameter' => $GLOBALS['TSFE']->id,
            'additionalParams' => '&type=' . $this->conf['typeNum'],
            'forceAbsoluteUrl' => '1'
        );
        return $this->cObj->typolink_URL($conf);
    }

    public function getSearch() {

        $templateSubpart = $this->cObj->getSubpart($this->templateCode, '###CONTENT###');
        $markerArray = array(
            '###SEARCHNAME###' => $this->conf['pluginName'],
            '###SEARCHDESCRIPTION###' => $this->conf['pluginDescription'],
            '###SEARCHURL###' => $this->getSearch_url(),
            '###SEARCHICON_PNG###' => $this->getSearch_icon($this->conf['pluginIcon'], 'png'),
            '###SEARCHICON_JPG###' => $this->getSearch_icon($this->conf['pluginIcon'], 'jpg'),
        );

        $entries[] = $this->cObj->substituteMarkerArray($templateSubpart, $markerArray);
        return implode('', $entries);
    }

    public function getPluginConfig(){

        $select_fields = '*';
		$from_table = 'tt_content';
		$where_clause =  'pid=' . intval($GLOBALS['TSFE']->id);
        $where_clause .= $this->cObj->enableFields($from_table);
		$groupBy = '';
		$orderBy = '';
		$limit = '1';

        $row = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
            $select_fields,
            $from_table,
            $where_clause,
            $groupBy,
            $orderBy,
            $limit
        );
        if(count($row) == 1){
            $this->cObj->readFlexformIntoConf($row[0]['pi_flexform'], $this->conf);
        }

    }
    public function getSearch_url() {

        return t3lib_div::getIndpEnv(TYPO3_SITE_URL)
            . 'index.php?eID=searchbar&amp;q={searchTerms}';
    }

    public function getSearch_icon($image, $ext) {

        if (empty($image)) {
            $pathWithImage = t3lib_extmgm::siteRelPath($this->extKey) . 'Resources/Public/Images/TYPO3_logo.png';
        } else {
            $pathWithImage = 'uploads/tx_searchbar/' . $image;
        }
        $widthAndHeight = '';
        if ($ext == 'png') {
            $widthAndHeight = '16';
        } else {
            $widthAndHeight = '64';
        }

        $imageConf = array(
            'file' => $pathWithImage,
            'file.' => array(
                'width' => $widthAndHeight,
                'height' => $widthAndHeight,
                'ext' => $ext,
            )
        );
        return t3lib_div::getIndpEnv(TYPO3_SITE_URL) . $this->cObj->IMG_RESOURCE($imageConf);

    }

}


if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/searchbar/pi1/class.tx_searchbar_pi1.php']) {
    include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/searchbar/pi1/class.tx_searchbar_pi1.php']);
}
