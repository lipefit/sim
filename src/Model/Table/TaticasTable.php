<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class TaticasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('tatica');
        $this->setDisplayField('voz');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
        
        $this->belongsTo('Curadorias', [
            'foreignKey' => 'curadoria_id'
        ]);
        $this->belongsTo('Toms', [
            'foreignKey' => 'tom_id'
        ]);
    }
    
    public function getStorytellings() {
        return array(
            'Inspirar' => 'Inspirar',
            'Entreter' => 'Entreter',
            'Educar' => 'Educar'
        );
    }
    
    public function getTipos() {
        return array(
            'E-book' => 'E-book',
            'E-mail Mkt' => 'E-mail Mkt',
            'Infográfico' => 'Infográfico'
        );
    }
    

}
