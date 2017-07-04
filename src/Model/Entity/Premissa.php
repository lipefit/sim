<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Premissa extends Entity {

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

    public function parentNode() {
        if (!$this->id) {
            return null;
        }
        if (isset($this->cliente_id)) {
            $clienteId = $this->cliente_id;
        } else {
            $Premissas = TableRegistry::get('Premissas');
            $premissa = $Premissas->find('all', ['fields' => ['cliente_id']])->where(['id' => $this->id])->first();
            $clienteId = $premissa->cliente_id;
        }
        if (!$clienteId) {
            return null;
        }
        return ['Cliente' => ['id' => $clienteId]];
    }

}