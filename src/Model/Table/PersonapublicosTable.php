<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PersonapublicosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('personapublico');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
    }
    
    public function getSexos() {
        return array(
            'Masculino' => 'Masculino',
            'Feminino' => 'Feminino'
        );
    }

    public function getGraduacoes() {
        return array(
            'Ensino Fundamental' => 'Ensino Fundamental',
            'Ensino Médio' => 'Ensino Médio',
            'Superior Completo' => 'Superior Completo',
            'Superior Imcompleto' => 'Superior Imcompleto',
            'Pós-Graduado' => 'Pós-Graduado',
            'Mestrado' => 'Mestrado',
            'Doutorado' => 'Doutorado'
        );
    }
    
    public function getArqueotipos() {
        return array(
            'Criador' => 'Criador',
            'Prestativo' => 'Prestativo',
            'Governante' => 'Governante',
            'Bobo da corte' => 'Bobo da corte',
            'Cara comum' => 'Cara comum',
            'Amante' => 'Amante',
            'Herói' => 'Herói',
            'Fora-da-lei' => 'Fora-da-lei',
            'Mago' => 'Mago',
            'Inocente' => 'Inocente',
            'Explorador' => 'Explorador',
            'Sábio' => 'Sábio',
            'Não definido' => 'Não definido'
        );
    }

}
