<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Funil Controller
 */
class FunilController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->loadModel("Personapublicos");
        $this->loadModel("Desafiospublicos");
        $this->loadModel("Pautas");
        $this->loadModel("Sociais");
        $this->loadModel("Conteudos");
        $this->loadModel("Revisaosociais");
	$cliente_id = $this->Cookie->read('cliente_id');

	$personas = $this->Personapublicos->find('list', [
	    'conditions' => [
		'Personapublicos.cliente_id' => $cliente_id
	    ]
	]);
	$this->set(compact('personas'));

	$jornadas = $this->Pautas->getJornadas();
	$this->set(compact('jornadas'));
        
	if ($this->request->is('post')) {
	    if (@$this->request->data['persona'] != "") {
		$conditionConteudo[]['Pautas.persona_id'] = $this->request->data['persona'];
		$conditionSocial[]['Revisaosociais.persona_id'] = $this->request->data['persona'];
	    }
	    if (@$this->request->data['desafio'] != "") {
		$conditionConteudo[]['Pautas.desafio_id'] = $this->request->data['desafio'];
		$conditionSocial[]['Revisaosociais.desafio_id'] = $this->request->data['desafio'];
	    }
	    if (@$this->request->data['jornada'] != "") {
		$conditionConteudo[]['Pautas.jornada'] = $this->request->data['jornada'];
		$conditionSocial[]['Revisaosociais.jornada'] = $this->request->data['jornada'];
	    }

	    if (@$conditionConteudo) {
		$conteudos= $this->Conteudos->find('all', [
		    'conditions' => [
			'AND' => $conditionConteudo,
			'Conteudos.status' => 'Publicado'
		    ],
		    'contain' => ['Pautas']
		]);
	    }

	    if (@$conditionSocial) {
		$sociais = $this->Revisaosociais->find('all', [
		    'conditions' => [
			'AND' => $conditionSocial,
			'Social.status' => 'Publicado'
		    ],
		    'contain' => ['Sociais']
		]);
	    }

	    $contAprendizado = 0;
	    $contReconhecimento = 0;
	    $contConsideracao = 0;
	    $contDecisao = 0;

	    if (@$conteudos) {
		foreach ($conteudos as $conteudo) {
		    switch ($conteudo['Pautas']['jornada']) {
			case "Aprendizado e descoberta":
			    $contAprendizado++;
			    break;
			case "Reconhecimento do problema":
			    $contReconhecimento++;
			    break;
			case "Consideração da solução":
			    $contConsideracao++;
			    break;
			case "Decisão de compra":
			    $contDecisao++;
			    break;
			default:
			    break;
		    }
		}
	    }

	    if (@$sociais) {
		foreach ($sociais as $social) {
		    switch ($social['Sociais']['jornada']) {
			case "Aprendizado e descoberta":
			    $contAprendizado++;
			    break;
			case "Reconhecimento do problema":
			    $contReconhecimento++;
			    break;
			case "Consideração da solução":
			    $contConsideracao++;
			    break;
			case "Decisão de compra":
			    $contDecisao++;
			    break;
			default:
			    break;
		    }
		}
	    }

	    $this->set('contAprendizado', $contAprendizado);
	    $this->set('contReconhecimento', $contReconhecimento);
	    $this->set('contConsideracao', $contConsideracao);
	    $this->set('contDecisao', $contDecisao);
	    $this->set('conteudos', @$conteudos);
	}
    }

    public function ver() {
	if ($this->request->is('post')) {
	    if (@$this->request->data['Jornadacompra']['persona_id'] != "") {
		$conditionMaterial[]['Jornada.persona_id'] = $this->request->data['Jornadacompra']['persona_id'];
		$conditionSocial[]['Social.persona_id'] = $this->request->data['Jornadacompra']['persona_id'];
		$persona = $this->Persona->find('first', array(
		    'conditions' => array(
			'Persona.id' => $this->request->data['Jornadacompra']['persona_id']
		    )
		));
	    }
	    if (@$this->request->data['Jornadacompra']['desafio_id'] != "") {
		$conditionMaterial[]['Jornada.desafio_id'] = $this->request->data['Jornadacompra']['desafio_id'];
		$conditionSocial[]['Social.desafio_id'] = $this->request->data['Jornadacompra']['desafio_id'];
		$desafio = $this->Desafio->find('first', array(
		    'conditions' => array(
			'Desafio.id' => $this->request->data['Jornadacompra']['desafio_id']
		    )
		));
	    }
	    if (@$this->request->data['Jornadacompra']['etapa'] != "") {
		$conditionMaterial[]['Jornada.etapa'] = $this->request->data['Jornadacompra']['etapa'];
		$conditionSocial[]['Social.etapa'] = $this->request->data['Jornadacompra']['etapa'];
		$etapa = $this->request->data['Jornadacompra']['etapa'];
	    }

	    if (@$conditionMaterial) {
		$materiais = $this->Material->find('all', array(
		    'conditions' => array(
			'AND' => $conditionMaterial,
			'Material.status' => 4
		    ),
		    'recursive' => 1
		));
	    }

	    if (@$conditionSocial) {
		$sociais = $this->Social->find('all', array(
		    'conditions' => array(
			'AND' => $conditionSocial,
			'Social.status' => 4
		    ),
		    'recursive' => 1
		));
	    }

	    $this->set('materiais', @$materiais);
	    $this->set('persona', @$persona);
	    $this->set('desafio', @$desafio);
	    $this->set('etapa', @$etapa);
	}
    }
    
    public function detalhes() {
	if ($this->request->is('post')) {
	    if (@$this->request->data['Jornadacompra']['persona_id'] != "") {
		$conditionMaterial[]['Jornada.persona_id'] = $this->request->data['Jornadacompra']['persona_id'];
		$conditionSocial[]['Social.persona_id'] = $this->request->data['Jornadacompra']['persona_id'];
	    }
	    if (@$this->request->data['Jornadacompra']['desafio_id'] != "") {
		$conditionMaterial[]['Jornada.desafio_id'] = $this->request->data['Jornadacompra']['desafio_id'];
		$conditionSocial[]['Social.desafio_id'] = $this->request->data['Jornadacompra']['desafio_id'];
	    }
	    if (@$this->request->data['Jornadacompra']['etapa'] != "") {
		$conditionMaterial[]['Jornada.etapa'] = $this->request->data['Jornadacompra']['etapa'];
		$conditionSocial[]['Social.etapa'] = $this->request->data['Jornadacompra']['etapa'];
	    }

	    if (@$conditionMaterial) {
		$materiais = $this->Material->find('all', array(
		    'conditions' => array(
			'AND' => $conditionMaterial,
			'Material.status' => 4
		    ),
		    'recursive' => 2
		));
	    }

	    if (@$conditionSocial) {
		$sociais = $this->Social->find('all', array(
		    'conditions' => array(
			'AND' => $conditionSocial,
			'Social.status' => 4
		    ),
		    'recursive' => 1
		));
	    }

	    $this->set('materiais', @$materiais);
	}
    }

    public function selecionaDesafio() {
        $this->loadModel('Desafiospublicos');
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $desafios = $this->Desafiospublicos->find('all', array(
                'conditions' => array(
                    'Desafiospublicos.personapublico_id' => $this->request->query['id']
                )
            ));
        }
        $i = 0;
        foreach ($desafios as $k => $desafio) {
            $array[$i]['id'] = $k;
            $array[$i]['desafio'] = $desafio['desafio'];
            $i++;
        }

        $return = json_encode($array);
        $this->response->type('json');
        $this->response->body($return);
        return $this->response;
    }
}
