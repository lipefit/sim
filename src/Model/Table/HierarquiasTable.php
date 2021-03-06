<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class HierarquiasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('hierarquias');
        $this->setDisplayField('hierarquia');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsToMany('Users', [
            'joinTable' => 'user_has_hierarquias',
        ]);

    }
    
}
