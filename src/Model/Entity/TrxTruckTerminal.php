<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TrxTruckTerminal Entity.
 *
 * @property int $truck_id
 * @property \App\Model\Entity\Truck $truck
 * @property int $terminal_id
 * @property \App\Model\Entity\Terminal $terminal
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $gross_weight
 * @property int $container_id
 * @property \App\Model\Entity\Container $container
 * @property int $voy_in
 * @property int $voy_out
 * @property \Cake\I18n\Time $trx_date
 */
class TrxTruckTerminal extends Entity
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
        'truck_id' => false,
    ];
}
