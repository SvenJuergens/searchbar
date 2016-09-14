<?php
namespace SvenJuergens\Searchbar\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Items
 */
class Items extends AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * HotKey
     *
     * @var string
     */
    protected $hotkey = '';

    /**
     * glue
     *
     * @var string
     */
    protected $glue = '';

    /**
     * searchUrl
     *
     * @var string
     */
    protected $searchurl = '';

    /**
     * TypoScript
     *
     * @var string
     */
    protected $typoscript = '';

    /**
     * itemtype
     *
     * @var int
     */
    protected $itemtype = 0;

    /**
     * additionalfunctions
     *
     * @var string
     */
    protected $additionalfunctions = '';

    /**
     * hideInFe
     *
     * @var bool
     */
    protected $hideinfe = false;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the hotkey
     *
     * @return string $hotkey
     */
    public function getHotkey()
    {
        return $this->hotkey;
    }

    /**
     * Sets the hotkey
     *
     * @param string $hotkey
     * @return void
     */
    public function setHotkey($hotkey)
    {
        $this->hotkey = $hotkey;
    }

    /**
     * Returns the glue
     *
     * @return string $glue
     */
    public function getGlue()
    {
        return $this->glue;
    }

    /**
     * Sets the glue
     *
     * @param string $glue
     * @return void
     */
    public function setGlue($glue)
    {
        $this->glue = $glue;
    }

    /**
     * Returns the searchurl
     *
     * @return string $searchurl
     */
    public function getSearchurl()
    {
        return $this->searchurl;
    }

    /**
     * Sets the searchurl
     *
     * @param string $searchurl
     * @return void
     */
    public function setSearchurl($searchurl)
    {
        $this->searchurl = $searchurl;
    }

    /**
     * Returns the typoscript
     *
     * @return string $typoscript
     */
    public function getTyposcript()
    {
        return $this->typoscript;
    }

    /**
     * Sets the typoscript
     *
     * @param string $typoscript
     * @return void
     */
    public function setTyposcript($typoscript)
    {
        $this->typoscript = $typoscript;
    }

    /**
     * Returns the itemtype
     *
     * @return int $itemtype
     */
    public function getItemtype()
    {
        return $this->itemtype;
    }

    /**
     * Sets the itemtype
     *
     * @param int $itemtype
     * @return void
     */
    public function setItemtype($itemtype)
    {
        $this->itemtype = $itemtype;
    }

    /**
     * Returns the additionalfunctions
     *
     * @return string $additionalfunctions
     */
    public function getAdditionalfunctions()
    {
        return $this->additionalfunctions;
    }

    /**
     * Sets the additionalfunctions
     *
     * @param string $additionalfunctions
     * @return void
     */
    public function setAdditionalfunctions($additionalfunctions)
    {
        $this->additionalfunctions = $additionalfunctions;
    }

    /**
     * Returns the hideinfe
     *
     * @return bool $hideinfe
     */
    public function getHideinfe()
    {
        return $this->hideinfe;
    }

    /**
     * Sets the hideinfe
     *
     * @param bool $hideinfe
     * @return void
     */
    public function setHideinfe($hideinfe)
    {
        $this->hideinfe = $hideinfe;
    }

    /**
     * Returns the boolean state of hideinfe
     *
     * @return bool
     */
    public function isHideinfe()
    {
        return $this->hideinfe;
    }

}