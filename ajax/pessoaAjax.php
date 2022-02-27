<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])){
    require_once "../controllers/PessoaController.php";
    $insertObj =  new PessoaController();

    switch ($_POST['_method']){
        case 'cadastraPessoa':
            echo $insertObj->cadastrarPessoa($_POST);
            break;
        case 'editaPessoa':
            echo $insertObj->editarPessoa($_POST, $_POST['id']);
            break;
        case 'apagaPessoa':
            echo $insertObj->apagarPessoa($_POST['id']);
            break;
        default:
            include_once "../config/destroySession.php";
            break;
    }

} else {
    include_once "../config/destroySession.php";
}
