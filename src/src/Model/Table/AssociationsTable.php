<?php
namespace App\Model\Table;

use App\Model\Entity\Association;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Associations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Headquarters
 * @property \Cake\ORM\Association\HasMany $Restaurants
 * @property \Cake\ORM\Association\HasMany $Users
 */
class AssociationsTable extends Table
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

        $this->table('associations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Headquarters', [
            'foreignKey' => 'headquarter_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Restaurants', [
            'foreignKey' => 'association_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'association_id'
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
            ->requirePresence('acronym', 'create')
            ->notEmpty('acronym');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['headquarter_id'], 'Headquarters'));
        return $rules;
    }
}
