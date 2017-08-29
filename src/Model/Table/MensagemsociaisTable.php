<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MensagemsociaisTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('mensagem_social');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sociais', [
            'foreignKey' => 'social_id'
        ]);

        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
        ]);
    }
}
