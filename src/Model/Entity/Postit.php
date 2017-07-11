<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Postit extends Entity {

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
        if (isset($this->canvas_id)) {
            $canvasId = $this->canvas_id;
        } else {
            $Postit = TableRegistry::get('Postit');
            $postit = $Postit->find('all', ['fields' => ['canvas_id']])->where(['id' => $this->id])->first();
            $canvasId = $postit->canvas_id;
        }
        if (!$cancasId) {
            return null;
        }
        return ['Canvas' => ['id' => $canvasId]];
    }

}