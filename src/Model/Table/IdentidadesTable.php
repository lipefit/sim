<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class IdentidadesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('identidade');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
    }
}
