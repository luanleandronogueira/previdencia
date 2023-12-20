<?php 

class Mensagem {

    private $nome = null;

    private $email = null;

    private $assunto = null;

    private $conteudo = null;



    public function __get($atributo)
    {
        return $this->$atributo;

    } 

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
} 

$mensagem = new Mensagem();

$mensagem->__set('NomeCompleto', $_REQUEST['NomeCompleto']);
$mensagem->__set('Email', $_REQUEST['Email']);
$mensagem->__set('Assunto', $_REQUEST['Assunto']);
$mensagem->__set('Mensagem', $_REQUEST['Mensagem']);

print_r($mensagem);



?>