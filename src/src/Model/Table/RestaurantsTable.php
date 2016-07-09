<?php
namespace App\Model\Table;

use App\Model\Entity\Restaurant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Restaurants Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Associations
 * @property \Cake\ORM\Association\HasMany $Categories
 * @property \Cake\ORM\Association\HasMany $Menus
 */
class RestaurantsTable extends Table
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

        $this->table('restaurants');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Associations', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Categories', [
            'foreignKey' => 'restaurant_id'
        ]);
        $this->hasMany('Menus', [
            'foreignKey' => 'restaurant_id'
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
            ->allowEmpty('schedule');

        $validator
            ->integer('card')
            ->allowEmpty('card');

        $validator
            ->numeric('x')
            ->requirePresence('x', 'create')
            ->notEmpty('x');

        $validator
            ->numeric('y')
            ->requirePresence('y', 'create')
            ->notEmpty('y');

        $validator
            ->allowEmpty('image_name');
            
        $validator
            ->notEmpty('name');
        
        $validator
            ->notEmpty('association_id');
            
        $validator
        ->notEmpty('email')
        ->add('email', 'validFormat', [
            'rule' => 'email',
            'message' => 'Dirección de email inválida'
        ])
       ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Dirección de email ya en uso']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['association_id'], 'Associations'));
        return $rules;
    }
}
