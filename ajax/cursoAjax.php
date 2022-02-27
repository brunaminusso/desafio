<?php
$pedidoAjax = true;
require_once "../config/configGeral.php";

if (isset($_POST['_method'])){
    require_once "../controllers/CursoController.php";
    $insertObj =  new CursoController();

    switch ($_POST['_method']){
        case 'cadastraCurso':
            echo $insertObj->cadastrarCurso($_POST);
            break;
        case 'editaCurso':
            echo $insertObj->editarCurso($_POST, $_POST['id']);
            break;
        case 'apagaCurso':
            echo $insertObj->apagarCurso($_POST['id']);
            break;
        default:
            include_once "../config/destroySession.php";
            break;
    }

} else {
    include_once "../config/destroySession.php";
}
