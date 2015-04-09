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
 * @package	TYPO3
 * @subpackage	tx_searchbar
 */
class tx_searchbar_pi1_wizicon {

	/**
	 * Path to locallang file (with : as postfix)
	 *
	 * @var string
	 */
	protected $locallangPath = 'LLL:EXT:searchbar/Resources/Private/Language/locallang_be.xlf:';

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array array with wizard items
	 */
	public function proc($wizardItems)	{
		$wizardItems['plugins_tx_searchbar_pi1'] = array(
			'icon' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('searchbar').'pi1/ce_wiz.gif',
			'title' =>  $GLOBALS['LANG']->sL( $this->locallangPath . 'pi1_title', TRUE ),
			'description' => $GLOBALS['LANG']->sL( $this->locallangPath . 'pi1_plus_wiz_description', TRUE), 
			'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=searchbar_pi1'
		);

		return $wizardItems;
	}
}