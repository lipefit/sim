<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ProjetotarefasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('projeto_tarefa');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Projetoatividades', [
            'foreignKey' => 'atividade_id',
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'responsavel',
        ]);

    }
}
