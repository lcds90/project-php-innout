<?php 

/* a requisição chega pelo controller,
sendo a porta de entrada e o mesmo implementa lógica
para saber se é o view, model que serão interagidos */

loadModel('Login');
session_start();
$exception = null;

 // Verifica se usuário está logado através de requisição que vem do formulário
if(count($_POST) > 0){
    $login = new Login($_POST);
    try{
        $user = $login->checkLogin();
        $_SESSION['user'] = $user;
        header("Location: day_records.php");
    } catch(AppException $e){
        $exception = $e;
    }
}

/* Função responsável por guardar em parametros que são passados
tudo que estava dentro de post foi passado como parametro em view
Além dos dados do POST, está concatenado a chave de exception, disponivel dentro da  */ 
loadView('login', $_POST + ['exception' => $exception]);

