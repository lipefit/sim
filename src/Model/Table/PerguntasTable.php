<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PerguntasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('perguntas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Checklists', [
            'foreignKey' => 'checklist_id'
        ]);
    }
}
