<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PrincipaisobjetivosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('principalobjetivo');
        $this->setDisplayField('conteudo');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');

        $this->belongsTo('Objetivos', [
            'foreignKey' => 'objetivo_id'
        ]);
    }
}
