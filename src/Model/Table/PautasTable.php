<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PautasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('pauta');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);

        $this->belongsTo('Personapublicos', [
            'foreignKey' => 'persona_id'
        ]);

        $this->belongsTo('Desafiospublicos', [
            'foreignKey' => 'desafio_id'
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
    
    public function getJornadas() {
        return array(
            'Aprendizado e descoberta' => 'Aprendizado e descoberta',
            'Reconhecimento do problema' => 'Reconhecimento do problema',
            'Consideração da solução' => 'Consideração da solução',
            'Decisão de compra' => 'Decisão de compra'
        );
    }
    
    public function getTipos() {
        return array(
            'Blog' => 'Blog',
            'E-mail marketing' => 'E-mail marketing',
            'Redes sociais' => 'Redes sociais',
            'Ebook' => 'Ebook',
            'Landing pages' => 'Landing pages'
        );
    }
    
    public function getTiposEdit() {
        return array(
            'Blog' => 'Blog'
        );
    }

}
