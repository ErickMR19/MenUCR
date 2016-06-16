<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Association Entity.
 *
 * @property int $id
 * @property string $acronym
 * @property string $name
 * @property int $headquarter_id
 * @property \App\Model\Entity\Headquarters $headquarters
 * @property \App\Model\Entity\Restaurant[] $restaurants
 * @property \App\Model\Entity\User[] $users
 */
class Association extends Entity
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
        'id' => false,
    ];
}
