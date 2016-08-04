<?php
namespace App\Model\Table;

use App\Model\Entity\Terminal;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terminal Model
 *
 * @property \Cake\ORM\Association\HasMany $TrxTruckTerminal
 * @property \Cake\ORM\Association\HasMany $TrxUserTerminal
 */
class TerminalTable extends Table
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

        $this->table('terminal');
        $this->displayField('terminalId');
        $this->primaryKey('terminalId');

        $this->hasMany('TrxTruckTerminal', [
            'foreignKey' => 'terminal_id'
        ]);
        $this->hasMany('TrxUserTerminal', [
            'foreignKey' => 'terminal_id'
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
            ->integer('terminalId')
            ->allowEmpty('terminalId', 'create');

        $validator
            ->requirePresence('terminal', 'create')
            ->notEmpty('terminal');

        return $validator;
    }
}
