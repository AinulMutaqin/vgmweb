<?php
namespace App\Model\Table;

use App\Model\Entity\Lane;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lane Model
 *
 */
class LaneTable extends Table
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

        $this->table('lane');
        $this->displayField('terminalId');
        $this->primaryKey('terminalId');
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
            ->integer('terminalId')
            ->allowEmpty('terminalId', 'create');

        $validator
            ->requirePresence('lane', 'create')
            ->notEmpty('lane');

        return $validator;
    }
}
