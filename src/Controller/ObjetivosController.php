<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Objetivos Controller
 *
 * @property \App\Model\Table\ObjetivosTable $Objetivos
 *
 * @method \App\Model\Entity\Objetivos[] paginate($object = null, array $settings = [])
 */
class ObjetivosController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->loadModel('Principaisobjetivos');
        $this->loadModel('Objetivoscontratos');
        $this->loadModel('Maioresobjetivos');
        $this->loadModel('Consideracoes');
        
        $idCliente = $this->Cookie->read('cliente_id');
        
        $objetivos = $this->Objetivos->find('all', [
            'conditions' => [
                'Objetivos.cliente_id' => $idCliente
            ]
        ]);
        $objetivo = $objetivos->first();
        
        $pos = $this->Principaisobjetivos->find('all', [
            'conditions' => [
                'Principaisobjetivos.objetivo_id' => @$objetivo->id
            ]
        ]);
        
        $ocs = $this->Objetivoscontratos->find('all', [
            'conditions' => [
                'Objetivoscontratos.objetivo_id' => @$objetivo->id
            ]
        ]);
        
        $mos = $this->Maioresobjetivos->find('all', [
            'conditions' => [
                'Maioresobjetivos.objetivo_id' => @$objetivo->id
            ]
        ]);
        
        $cs = $this->Consideracoes->find('all', [
            'conditions' => [
                'Consideracoes.objetivo_id' => @$objetivo->id
            ]
        ]);

        if($objetivo == null){
            $objetivo = $this->Objetivos->newEntity();
        }
               
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Objetivos']['cliente_id'] = $this->Cookie->read('cliente_id');
            
            $objetivo = $this->Objetivos->patchEntity($objetivo, $this->request->getData());
            if ($query = $this->Objetivos->save($objetivo)) {
                $idObjetivo = $query->id;
                
                $principaisobjetivosParaDeletar = $this->Principaisobjetivos->find('all', [
                    'conditions' => [
                        'Principaisobjetivos.objetivo_id' => $idObjetivo
                    ]
                ]);
                
                foreach ($principaisobjetivosParaDeletar as $popd){
                    $this->Principaisobjetivos->delete($popd);
                }
                
                $contPo = count($this->request->data['principalObjetivo']);
                for ($x = 0; $x < $contPo; $x++) {
                    if ($this->request->data['principalObjetivo'][$x] != "") {
                        $po = $this->Principaisobjetivos->newEntity();
                        $po->conteudo = $this->request->data['principalObjetivo'][$x];
                        $po->objetivo_id = $idObjetivo;
                        if(!$this->Principaisobjetivos->save($po)){
                            $this->Flash->error(__('O objetivo não foi atualizado. Por favor, tente novamente'));
                            return $this->redirect(['action' => 'index']);
                        }
                        
                    }
                }
                
                $objetivoscontratosParaDeletar = $this->Objetivoscontratos->find('all', [
                    'conditions' => [
                        'Objetivoscontratos.objetivo_id' => $idObjetivo
                    ]
                ]);
                
                foreach ($objetivoscontratosParaDeletar as $ocpd){
                    $this->Objetivoscontratos->delete($ocpd);
                }
                
                $contOc = count($this->request->data['objetivo']);
                for ($y = 0; $y < $contOc; $y++) {
                    if ($this->request->data['objetivo'][$y] != "") {
                        $oc = $this->Objetivoscontratos->newEntity();
                        $oc->conteudo = $this->request->data['objetivo'][$y];
                        $oc->objetivo_id = $idObjetivo;
                        if(!$this->Objetivoscontratos->save($oc)){
                            $this->Flash->error(__('O objetivo não foi atualizado. Por favor, tente novamente'));
                            return $this->redirect(['action' => 'index']);
                        }
                    }
                }
                
                $maioresbjetivosParaDeletar = $this->Maioresobjetivos->find('all', [
                    'conditions' => [
                        'Maioresobjetivos.objetivo_id' => $idObjetivo
                    ]
                ]);
                
                foreach ($maioresbjetivosParaDeletar as $mopd){
                    $this->Maioresobjetivos->delete($mopd);
                }
                
                $contMo = count($this->request->data['maiorObjetivo']);
                for ($w = 0; $w < $contMo; $w++) {
                    if ($this->request->data['maiorObjetivo'][$w] != "") {
                        $mo = $this->Maioresobjetivos->newEntity();
                        $mo->conteudo = $this->request->data['maiorObjetivo'][$w];
                        $mo->objetivo_id = $idObjetivo;
                        if(!$this->Maioresobjetivos->save($mo)){
                            $this->Flash->error(__('O objetivo não foi atualizado. Por favor, tente novamente'));
                            return $this->redirect(['action' => 'index']);
                        }                        
                    }
                }
                
                $consideracoesParaDeletar = $this->Consideracoes->find('all', [
                    'conditions' => [
                        'Consideracoes.objetivo_id' => $idObjetivo
                    ]
                ]);
                
                foreach ($consideracoesParaDeletar as $cpd){
                    $this->Consideracoes->delete($cpd);
                }
                
                $contC = count($this->request->data['consideracoes']);
                for ($z = 0; $z < $contC; $z++) {
                    if ($this->request->data['consideracoes'][$z] != "") {
                        $c = $this->Consideracoes->newEntity();
                        $c->conteudo = $this->request->data['consideracoes'][$z];
                        $c->objetivo_id = $idObjetivo;
                        if(!$this->Consideracoes->save($c)){
                            $this->Flash->error(__('O objetivo não foi atualizado. Por favor, tente novamente'));
                            return $this->redirect(['action' => 'index']);
                        }                        
                    }
                }
                
                $this->Flash->success(__('Objetivo atualizado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('O objetivo não foi atualizado. Por favor, tente novamente'));
                return $this->redirect(['action' => 'index']);
            }
            
        }
         
        $this->set(compact('objetivo'));
        $this->set(compact('pos'));
        $this->set(compact('ocs'));
        $this->set(compact('mos'));
        $this->set(compact('cs'));
        $this->set('_serialize', ['objetivo']);
    }
}