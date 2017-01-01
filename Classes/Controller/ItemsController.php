<?php
namespace SvenJuergens\Searchbar\Controller;

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


use SvenJuergens\Searchbar\Utility\Xml;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * ItemsController
 */
class ItemsController extends ActionController
{

    /**
     * itemsRepository
     *
     * @var \SvenJuergens\Searchbar\Domain\Repository\ItemsRepository
     * @inject
     */
    protected $itemsRepository = null;

    public function initializeSearchBarLinkAction()
    {
        //check if XmlDefinition is written to TempFile
        Xml::writeSearchBarDefinitionFile($this->settings);
    }

    /**
     * action searchbarLink
     *
     * @return void
     */
    public function searchBarLinkAction()
    {
        $linkToSearchDefinition = Xml::getLinkToXmlDefinition($this->settings);
        $this->view->assign('linkToSearchDefinition', $linkToSearchDefinition);
    }

    /**
     * Display a searchBarFrontEnd
     *
     * @return void
     */
    public function searchBarFrontEndAction()
    {
        $items = $this->itemsRepository->findAllHotKeys();
        $this->view->assign('items', $items);
    }

    /**
     * something went wrong in FleForm Config
     *
     * @return void
     */
    public function wrongFlexFormConfigAction()
    {
        $this->view->assign('items', '');
    }
}
