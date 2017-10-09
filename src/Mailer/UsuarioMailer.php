<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Acesso mailer.
 */
class UsuarioMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Usuario';
    
    public function enviarToken($dados){       
        $this->to($dados['email'])
                ->profile('default')
                ->template("usuario")
                ->emailFormat("html")
                ->layout("default")
                ->subject("Confirmação de cadastro")
                ->viewVars(['nome' => $dados['nome'],'token'=>$dados['token']]);
    }
}
