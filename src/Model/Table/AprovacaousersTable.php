<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AprovacaousersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('aprovacao_user');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Aprovacoes', [
            'foreignKey' => 'aprovacao_id'
        ]);
        
        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id'
        ]);
        
        $this->belongsTo('Hierarquias', [
            'foreignKey' => 'hierarquia_id'
        ]);

    }
    
}
