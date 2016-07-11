<?php
namespace App\Model\Table;

use App\Model\Entity\Dish;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Dishes Model
 *
 */
class DishesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('dishes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Restaurants', [
            'foreignKey' => 'restaurant_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('restaurant_id', 'create')
            ->notEmpty('restaurant_id');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }

    public function getRestaurantId($association_id = null)
    {
        $restaurant_id = null;

        if($association_id)
        {
            $restaurants = TableRegistry::get('Restaurants');
            $restaurant_id = $restaurants->find()
                ->select(['id'])
                ->where(['association_id'=>$association_id]);

            $restaurant_id = $restaurant_id->toArray();
        }

        return $restaurant_id;
    }

}
