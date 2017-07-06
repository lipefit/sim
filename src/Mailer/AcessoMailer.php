<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Acesso mailer.
 */
class AcessoMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Acesso';
    
    public function enviarSenha($dados){       
        $this->to($dados['email'])
                ->profile('default')
                ->template("acesso")
                ->emailFormat("html")
                ->layout("default")
                ->subject("Envio de senha")
                ->viewVars(['nome' => $dados['nome'],'senha'=>$dados['senha'],'acesso'=>$dados['acesso']]);
    }
}
