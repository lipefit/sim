<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class RevisaosociaisTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('revisao_social');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sociais', [
            'foreignKey' => 'social_id'
        ]);
        
        $this->belongsTo('aliasAutor', [
            'foreignKey' => 'autor',
            'className' => 'Profiles'
        ]);

        $this->belongsTo('aliasRevisor', [
            'foreignKey' => 'revisor',
            'className' => 'Profiles'
        ]);

        $this->belongsTo('aliasAprovador', [
            'foreignKey' => 'aprovador',
            'className' => 'Profiles'
        ]);
    }
    
}
