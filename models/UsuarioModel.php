<?php
/** @var $pedidoAjax */
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class UsuarioModel extends MainModel
{
    protected function getUsuario($dados) {
        $pdo = parent::connection();
        $sql = "SELECT * FROM usuario WHERE email = :usuario AND senha = :senha AND publicado = 1";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":usuario", $dados['usuario']);
        $statement->bindParam(":senha", $dados['senha']);
        $statement->execute();
        return $statement;
    }
}