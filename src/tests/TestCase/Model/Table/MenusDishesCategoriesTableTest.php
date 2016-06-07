<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenusDishesCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenusDishesCategoriesTable Test Case
 */
class MenusDishesCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenusDishesCategoriesTable
     */
    public $MenusDishesCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menus_dishes_categories',
        'app.menus',
        'app.restaurants',
        'app.dishes',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MenusDishesCategories') ? [] : ['className' => 'App\Model\Table\MenusDishesCategoriesTable'];
        $this->MenusDishesCategories = TableRegistry::get('MenusDishesCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenusDishesCategories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
