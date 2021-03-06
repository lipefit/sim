<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class DesafiosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('desafios');
        $this->setDisplayField('desafio');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Personas', [
            'foreignKey' => 'persona_id'
        ]);
    }

}
