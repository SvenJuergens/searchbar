<?php

namespace SvenJuergens\Searchbar\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
 *
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
 * Test case for class \SvenJuergens\Searchbar\Domain\Model\Items.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ItemsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \SvenJuergens\Searchbar\Domain\Model\Items
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \SvenJuergens\Searchbar\Domain\Model\Items();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHotkeyReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getHotkey()
		);
	}

	/**
	 * @test
	 */
	public function setHotkeyForStringSetsHotkey()
	{
		$this->subject->setHotkey('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'hotkey',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGlueReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getGlue()
		);
	}

	/**
	 * @test
	 */
	public function setGlueForStringSetsGlue()
	{
		$this->subject->setGlue('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'glue',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSearchurlReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getSearchurl()
		);
	}

	/**
	 * @test
	 */
	public function setSearchurlForStringSetsSearchurl()
	{
		$this->subject->setSearchurl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'searchurl',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTyposcriptReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTyposcript()
		);
	}

	/**
	 * @test
	 */
	public function setTyposcriptForStringSetsTyposcript()
	{
		$this->subject->setTyposcript('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'typoscript',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getItemtypeReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setItemtypeForIntSetsItemtype()
	{	}

	/**
	 * @test
	 */
	public function getAdditionalfunctionsReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getAdditionalfunctions()
		);
	}

	/**
	 * @test
	 */
	public function setAdditionalfunctionsForStringSetsAdditionalfunctions()
	{
		$this->subject->setAdditionalfunctions('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'additionalfunctions',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHideinfeReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getHideinfe()
		);
	}

	/**
	 * @test
	 */
	public function setHideinfeForBoolSetsHideinfe()
	{
		$this->subject->setHideinfe(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'hideinfe',
			$this->subject
		);
	}
}
