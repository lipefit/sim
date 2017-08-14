<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MensagempautasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('mensagem_pauta');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pautas', [
            'foreignKey' => 'pauta_id'
        ]);

        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
        ]);

    }
}
