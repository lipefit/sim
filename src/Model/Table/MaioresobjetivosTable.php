<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MaioresobjetivosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('maiorobjetivo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Objetivos', [
            'foreignKey' => 'objetivo_id'
        ]);
    }
}
