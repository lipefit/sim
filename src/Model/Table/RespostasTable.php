<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class RespostasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('respostas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Perguntas', [
            'foreignKey' => 'pergunta_id'
        ]);
    }
}
