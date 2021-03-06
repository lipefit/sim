<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AnexosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('anexo');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
        
        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id'
        ]);
    }
}
