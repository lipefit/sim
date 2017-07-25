<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class DesafiospublicosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('desafiospublicos');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Personapublicos', [
            'foreignKey' => 'personapublico_id'
        ]);
    }

}
