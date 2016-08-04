<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property int $userid
 * @property string $username
 * @property string $password
 * @property \App\Model\Entity\TrxTruckTerminal[] $trx_truck_terminal
 * @property \App\Model\Entity\TrxUserTerminal[] $trx_user_terminal
 */
class Users extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
		'*' => true,
        'userid' => false
    ];
	
	protected function _setPassword($value) {
        return (new DefaultPasswordHasher)->hash($password);
    }
	
    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
