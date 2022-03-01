<?php
/* @var $pedidoAjax */
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class PessoaModel extends MainModel
{
    public function limparStringPS($dados): array
    {
        unset($dados['_method']);
        unset($dados['pagina']);

        foreach ($dados as $campo => $post) {
            $dig = explode("_", $campo)[0];
            if (!empty($dados[$campo]) || ($dig == "ps")) {
                switch ($dig) {
                    case "ps":
                        $campo = substr($campo, 3);
                        $dadosLimpos['ps'][$campo] = MainModel::limparString($post);
                        break;
                    case "cp":
                        $campo = substr($campo, 3);
                        $dadosLimpos['cp'][$campo] = MainModel::limparString($post);
                        break;
                }
            }
        }
        return $dadosLimpos;
    }
}