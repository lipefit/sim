<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class DiagnosticosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('diagnostico');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
    }
    
    public function getRespostas() {
        return array(
            'Sim' => 'Sim',
            'Não' => 'Não'
        );
    }
}