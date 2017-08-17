<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SociaisTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('social');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
    }
    
    public function getTemas() {
        return array(
            'Informativo' => 'Informativo',
            'Institucional' => 'Institucional',
            'Blog' => 'Blog',
            'Ebook' => 'Ebook',
            'Emocional' => 'Emocional',
            'Citação' => 'Citação',
            'Promocional' => 'Promocional',
            'Dica' => 'Dica',
            'CTA' => 'CTA',
            'Outro' => 'Outro'
        );
    }
    
}
