<?php
namespace SvenJuergens\Searchbar\Utility;

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
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class Xml
{
	const PATH = 'typo3temp' . DIRECTORY_SEPARATOR . 'tx_searchbar' . DIRECTORY_SEPARATOR;

	/**
	 * Returns an absoulte Link to the XML Definition of the SearchBar
	 *
	 * @param  array $pluginSettings an array with Plugin Settings
	 * @return string               absoulte URL to the Searchbar XML Definition
	 */
	public static function getLinkToXmlDefinition( array $pluginSettings )
	{
		$fileName = self::getFileName( $pluginSettings );
		return GeneralUtility::getIndpEnv( TYPO3_SITE_URL ) . self::PATH . $fileName;
	}

	public static function writeSearchBarDefinitionFile( $pluginSettings )
	{
		$path = PATH_site .  self::PATH;
		$fileName = self::getFileName( $pluginSettings );

		if( is_file( $path . $fileName) ){
			return;
		}
		$templateFile = GeneralUtility::getFileAbsFileName( 'EXT:searchbar/Resources/Private/Templates/SearchBarDefinitonFile.xml' );
		$view = GeneralUtility::makeInstance( StandaloneView::class );
		$view->setTemplatePathAndFilename( $templateFile );

 		$defaultImagePath = GeneralUtility::getIndpEnv(TYPO3_SITE_URL) .  ExtensionManagementUtility::siteRelPath('searchbar') . 'Resources/Public/Icons/';

		$view->assignMultiple( array(
			'searchBarLink' => GeneralUtility::getIndpEnv(TYPO3_SITE_URL) . 'index.php?eID=searchbar&q={searchTerms}',
			'settings' => $pluginSettings,
		            'defaultJpg' => $defaultImagePath . 'typo3-logo.jpg',
		            'defaultPng' => $defaultImagePath . 'typo3-logo.png'
		));

		self::createDir( $path );
		GeneralUtility::writeFile( $path . $fileName, $view->render() );
	}

	public static function getFileName( array $pluginSettings)
	{
		return sha1( implode( ',', $pluginSettings) ) . '.xml';
	}


	public static function createDir( $path ){

		if( !is_dir( $path ) ){
			GeneralUtility::mkdir( $path );
		}
	}
}