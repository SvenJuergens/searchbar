<?php
namespace SvenJuergens\Searchbar\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
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
 * Test case for class SvenJuergens\Searchbar\Controller\ItemsController.
 *
 */
class ItemsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \SvenJuergens\Searchbar\Controller\ItemsController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('SvenJuergens\\Searchbar\\Controller\\ItemsController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllItemssFromRepositoryAndAssignsThemToView()
	{

		$allItemss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$itemsRepository = $this->getMock('SvenJuergens\\Searchbar\\Domain\\Repository\\ItemsRepository', array('findAll'), array(), '', FALSE);
		$itemsRepository->expects($this->once())->method('findAll')->will($this->returnValue($allItemss));
		$this->inject($this->subject, 'itemsRepository', $itemsRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('itemss', $allItemss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenItemsToView()
	{
		$items = new \SvenJuergens\Searchbar\Domain\Model\Items();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('items', $items);

		$this->subject->showAction($items);
	}
}
