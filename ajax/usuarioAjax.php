<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])) {
    require_once "../controllers/UsuarioController.php";
    $usuarioObj = new UsuarioController();

    switch ($_POST['_method']){
        case "cadastraUsuario":
            echo $usuarioObj->cadastrar($_POST);
            break;
        case "editaUsuario":
            echo $usuarioObj->editar($_POST, $_POST['pessoa_id']);
            break;
        case "trocaSenhaUsuario":
            echo $usuarioObj->trocaSenha($_POST,$_POST['id']);
            break;
        case "removerUsuario":
            echo $usuarioObj->remover($_POST['pessoa_id']);
            break;
        case "recuperarUsuario":
            echo $usuarioObj->reativar($_POST['id']);
            break;
        case "resetarSenha":
            echo $usuarioObj->resetSenha($_POST['id']);
            break;
        default:
            include_once "../config/destroySession.php";
            break;
    }
} else{
    include_once "../config/destroySession.php";
}