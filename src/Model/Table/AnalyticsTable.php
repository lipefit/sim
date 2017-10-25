<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AnalyticsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('analytics');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cliente', [
            'foreignKey' => 'cliente_id'
        ]);
        
        $this->belongsTo('Revisaos', [
            'foreignKey' => 'revisao_id'
        ]);

    }
    
}
