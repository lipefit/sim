<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PersonasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('persona');
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

    public function getSegmentos() {
        return array(
            'Agropecuária' => 'Agropecuária',
            'Água, gás e saneamento' => 'Água, gás e saneamento',
            'Alimentos processados' => 'Alimentos processados',
            'Bancos' => 'Bancos',
            'Carnes e derivados' => 'Carnes e derivados',
            'Construção civil e intermediação' => 'Construção civil e intermediação',
            'Construção pesada e engenharia' => 'Construção pesada e engenharia',
            'Energia elétrica' => 'Energia elétrica',
            'Equipamentos, máquinas e peças' => 'Equipamentos, máquinas e peças',
            'Holdings' => 'Holdings',
            'Hotelaria e Restaurantes' => 'Hotelaria e Restaurantes',
            'Imóveis comerciais e shoppings' => 'Imóveis comerciais e shoppings',
            'Indústrias de alimentos' => 'Indústrias de alimentos',
            'Indústrias em geral' => 'Indústrias em geral',
            'Materiais diversos' => 'Materiais diversos',
            'Mineração' => 'Mineração',
            'Negócios de lazer e eventos' => 'Negócios de lazer e eventos',
            'Papel e madeira' => 'Papel e madeira',
            'Petróleo, gás e combustíveis' => 'Petróleo, gás e combustíveis',
            'Química e petroquímica' => 'Química e petroquímica',
            'Roupas, calçados e acessórios' => 'Roupas, calçados e acessórios',
            'Serviços diversos' => 'Serviços diversos',
            'Serviços financeiros' => 'Serviços financeiros',
            'Setor de educação' => 'Setor de educação',
            'Setor de saúde' => 'Setor de saúde',
            'Setor de seguros' => 'Setor de seguros',
            'Setor de transporte' => 'Setor de transporte',
            'Siderurgia e metalurgia' => 'Siderurgia e metalurgia',
            'Tecnologia da informação' => 'Tecnologia da informação',
            'Telecomunicações' => 'Telecomunicações',
            'Têxteis' => 'Têxteis',
            'Utilidades domésticas' => 'Utilidades domésticas',
            'Varejo' => 'Varejo'
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
