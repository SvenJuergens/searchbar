<?php
namespace SvenJuergens\Searchbar\Eid;

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

use SvenJuergens\Searchbar\Domain\Model\Items;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\Utility\EidUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;

use TYPO3\CMS\Core\TypoScript\Parser\TypoScriptParser;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Fluid\View\StandaloneView;

use TYPO3\CMS\Extbase\Object\ObjectManager;
use SvenJuergens\Searchbar\Domain\Repository\ItemsRepository;

class MainEid
{

    const TYPE_NORMAL     = 0;
    const TYPE_TYPOSCRIPT = 1;
    const TYPE_FUNCTIONS  = 2;

    public $query;
    public $table = 'tx_searchbar_items';

    public $extensionConfiguration;

    /**
     * MainEid constructor.
     */
    public function __construct()
    {
        EidUtility::initTCA();

        $this->extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['searchbar']);
        $this->query = htmlspecialchars(GeneralUtility::_GET('q'));
        if (empty($this->query)) {
            $value = GeneralUtility::_GET('tx_searchbarfrontend_pi1');
            if (is_array($value)) {
                $this->query = htmlspecialchars($value['q']);
            }
        }
        //Explode Array to Hotkey and searchword
        $this->query = GeneralUtility::trimExplode(' ', $this->query, true);

        //check if we should show the help / Overview of all Hotkeys
        if (isset($this->query[0]) && strtolower($this->query[0]) == 'help') {
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

    /**
     *
     */
    public function main()
    {
        // get record
        $row = $this->getRecords($this->query[0]);
        if ($row->count() === 0 && $this->extensionConfiguration['useDefaultHotKey'] == 1) {
            $temp = [htmlspecialchars($this->extensionConfiguration['defaultHotKey'])];
            $this->query = array_merge($temp, $this->query);
            $row = $this->getRecords($this->query[0]);
        }
        if ($row->count() === 0) {
            $this->showHelp();
        }
        $this->getRedirect($row->getFirst());
    }

    /**
     * @param Items $row
     */
    public function getRedirect($row)
    {

        unset($this->query['0']);
        $urlPart = '';

        if ($row->getItemtype() == self::TYPE_TYPOSCRIPT) {
            $urlPart = $this->getTypoScriptCode($row);
        } elseif ($row->getItemtype() == self::TYPE_NORMAL) {
            $urlPart = implode(
                $row->getGlue(),
                $this->query
            );
        }
        if (strpos($row->getSearchurl(), '###SEARCHWORD###') !== false) {
            $url = str_replace(
                '###SEARCHWORD###',
                $urlPart,
                $row->getSearchurl()
            );
        } else {
            $url = $row->getSearchurl() . $urlPart;
        }

        if ($row->getItemtype() == self::TYPE_FUNCTIONS) {
            $classConfig = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions'][$row->getAdditionalfunctions()];
            if (isset($classConfig['namespaceOfClass']) && !empty($classConfig['namespaceOfClass'])) {
                if (class_exists($classConfig['namespaceOfClass'])) {
                    $userfile = GeneralUtility::makeInstance($classConfig['namespaceOfClass']);
                    $url = $userfile->execute($row, $this->query);
                }
            }
        }
        HttpUtility::redirect($url);
    }

    /**
     * @param Items $row
     * @return mixed
     */
    public function getTypoScriptCode(&$row)
    {
        $typoScriptCode = str_replace(
            '###INPUT###',
            implode($row->getGlue(), $this->query),
            $row->getTyposcript()
        );

        $TSparserObject = GeneralUtility::makeInstance(TypoScriptParser::class);
        $TSparserObject->parse($typoScriptCode);

        $contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $contentObject->start(array(), '');

        /** @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $typoScriptFrontendController */
        $GLOBALS['TSFE'] = GeneralUtility::makeInstance(
            TypoScriptFrontendController::class,
            $GLOBALS['TYPO3_CONF_VARS'],
            1, // page ID
            0 // pageType.
        );
        return $contentObject->cObjGet($TSparserObject->setup);
    }

    public function getRecords($hotKey = null)
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        /** @var ItemsRepository $Repository */
        $Repository = $objectManager->get(ItemsRepository::class);
        if ($hotKey !== null) {
            $items = $Repository->findByHotKey($hotKey);
        } else {
            $items = $Repository->findAllHotKeys();
        }
        return $items;
    }

    public function showHelp()
    {

        if ($this->extensionConfiguration['showHelp'] != 1) {
            return;
        }
        $items = $this->getRecords();
        $templateFile = GeneralUtility::getFileAbsFileName($this->extensionConfiguration['helpTemplateFile']);
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($templateFile);

        $view->assign('items', $items);
        echo $view->render();
        exit;
    }
}

// Make instance:
$eid = GeneralUtility::makeInstance(MainEid::class);
$eid->main();
