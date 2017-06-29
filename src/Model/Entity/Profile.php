<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Profile extends Entity {

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
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    public function parentNode() {
        if (!$this->id) {
            return null;
        }
        if (isset($this->user_id)) {
            $userId = $this->user_id;
        } else {
            $Profiles = TableRegistry::get('Profiles');
            $profile = $Profiles->find('all', ['fields' => ['user_id']])->where(['id' => $this->id])->first();
            $userId = $profile->user_id;
        }
        if (!$userId) {
            return null;
        }
        return ['Users' => ['id' => $userId]];
    }

}
