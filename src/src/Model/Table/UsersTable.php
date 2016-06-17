<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Associations
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Associations', [
            'foreignKey' => 'association_id'
        ]);
    }
    
    
    /**
     * Validation rules when changin password.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationChangePassword(Validator $validator)
    {    
        $validator
            ->add('old_password','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user && (new DefaultPasswordHasher)->check($value, $user->password)) {
                        return true;
                    }
                    return false;
                },
                'message'=>'La contraseña antigua no coincide',
                'errorField' =>'old_password'
            ])
            ->notEmpty('old_password');
 
        $validator
            ->add('password1', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password have to be at least 6 characters!',
                ]
            ])
            ->add('password1',[
                'match'=>[
                    'rule'=> ['compareWith','password2'],
                    'message'=>'The passwords does not match!',
                ]
            ])
            ->notEmpty('password1');
 
        return $validator;
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'validFormat', [
                'rule' => 'email',
                'message' => 'Dirección de email inválida'
            ])
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->integer('state')
            ->allowEmpty('state');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('last_name_1', 'create')
            ->notEmpty('last_name_1');

        $validator
            ->allowEmpty('last_name_2');

       $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');
        
         $validator
            ->requirePresence('association_id', function ($context) {
                if ( ! isset($context['data']['role']) )
                    return false;
                else
                { 
                    return ! ($context['data']['role'] == 'admin');
                }                
            })
            ->notEmpty('association_id');
        
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['association_id'], 'Associations'));
        $rules->add(function ($entity, $options) {
            return ($entity['role']=='admin' || $entity['role']=='manager');
        },'roleValid',['errorField'=>'role', 'message'=>'Rol seleccionado inválido']);
        return $rules;
    }
    
}
