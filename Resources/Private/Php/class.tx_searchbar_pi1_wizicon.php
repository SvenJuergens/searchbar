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

/**
 * Class that adds the wizard icon.
 *
 * @author	Sven Jürgens <t3@blue-side.de>
 * @package	TYPO3
 * @subpackage	tx_searchbar
 */
class tx_searchbar_pi1_wizicon {

					/**
					 * Processing the wizard items array
					 *
					 * @param	array		$wizardItems: The wizard items
					 * @return	Modified array with wizard items
					 */
					function proc($wizardItems)	{
						global $LANG;

						$LL = $this->includeLocalLang();

						$wizardItems['plugins_tx_searchbar_pi1'] = array(
							'icon'=>t3lib_extMgm::extRelPath('searchbar').'pi1/ce_wiz.gif',
							'title'=>$LANG->getLLL('pi1_title',$LL),
							'description'=>$LANG->getLLL('pi1_plus_wiz_description',$LL),
							'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=searchbar_pi1'
						);

						return $wizardItems;
					}

					/**
					 * Reads the [extDir]/locallang.xml and returns the $LOCAL_LANG array found in that file.
					 *
					 * @return	The array with language labels
					 */
					function includeLocalLang()	{
						$llFile = t3lib_extMgm::extPath('searchbar').'locallang.xml';
						if(class_exists('TYPO3\\CMS\\Core\\Localization\\Parser\\LocallangXmlParser') && is_callable('TYPO3\\CMS\\Core\\Localization\\Parser\\LocallangXmlParser::getParsedTargetData')){
							$this->parser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Localization\\Parser\\LocallangXmlParser');
							$LOCAL_LANG = $this->parser->getParsedData($llFile, $GLOBALS['LANG']->lang);
						}else{
							$LOCAL_LANG = t3lib_div::readLLXMLfile($llFile, $GLOBALS['LANG']->lang);
						}		
						return $LOCAL_LANG;
					}
				}



if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/searchbar/pi1/class.tx_searchbar_pi1_wizicon.php'])	{
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/searchbar/pi1/class.tx_searchbar_pi1_wizicon.php']);
}