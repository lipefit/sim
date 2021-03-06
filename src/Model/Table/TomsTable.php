<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class TomsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('toms');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
    }

}
