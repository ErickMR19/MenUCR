<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MenusDishesCategoriesFixture
 *
 */
class MenusDishesCategoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'menu_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dishe_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'category_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'dishe_id' => ['type' => 'index', 'columns' => ['dishe_id'], 'length' => []],
            'category_id' => ['type' => 'index', 'columns' => ['category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'menu_id' => ['type' => 'unique', 'columns' => ['menu_id', 'dishe_id', 'category_id'], 'length' => []],
            'menus_dishes_categories_ibfk_1' => ['type' => 'foreign', 'columns' => ['menu_id'], 'references' => ['menus', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'menus_dishes_categories_ibfk_2' => ['type' => 'foreign', 'columns' => ['dishe_id'], 'references' => ['dishes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'menus_dishes_categories_ibfk_3' => ['type' => 'foreign', 'columns' => ['category_id'], 'references' => ['categories', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_spanish2_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'menu_id' => 1,
            'dishe_id' => 1,
            'category_id' => 1,
            'date' => '2016-06-03'
        ],
    ];
}
