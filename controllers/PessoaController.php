<?php
/* @var $pedidoAjax */
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class PessoaController extends MainModel
{
    /**
     * <p>Cadastro de pessoa</p>
     * @param $dados
     * @return string
     */
    public function cadastrarPessoa($dados):string
    {
        unset($dados['_method']);
        $dados = MainModel::limpaPost($dados);

        $insert = DbModel::insert("pessoas", $dados);
        if ($insert->rowCount() >= 1) {
            $id = $this->connection()->lastInsertId();
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Pessoa cadastrada!',
                'texto' => 'Dados cadastrados com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . "pessoa_cadastro&id=".MainModel::encryption($id)
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Oops! Algo deu Errado!',
                'texto' => 'Falha ao salvar os dados no servidor, tente novamente mais tarde',
                'tipo' => 'error',
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    /**
     * <p>Edição de pessoa</p>
     * @param $dados
     * @param $id
     * @return string
     */
    public function editarPessoa($dados, $id):string
    {
        unset($dados['_method']);
        unset($dados['id']);
        $dados = MainModel::limpaPost($dados);
        $id = MainModel::decryption($id);
        $update = DbModel::update('pessoas', $dados, $id);

        if ($update->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Pessoa alterado com sucesso!',
                'texto' => 'Dados alterados com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . "pessoa_cadastro&id=".MainModel::encryption($id)
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Oops! Algo deu Errado!',
                'texto' => 'Falha ao salvar os dados no servidor, tente novamente mais tarde',
                'tipo' => 'error',
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    /**
     * <p>Apagar pessoa</p>
     * @param $id
     * @return string
     */
    public function apagarPessoa($id):string
    {
        $apagar = $this->apaga("pessoas",$id);
        if ($apagar->rowCount() >= 1){
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Pessoa apagado!',
                'texto' => 'Dados alterados com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . 'pessoa_lista'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Oops! Algo deu Errado!',
                'texto' => 'Falha ao salvar os dados no servidor, tente novamente mais tarde',
                'tipo' => 'error',
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    /**
     * <p>Lista para pessoas</p>
     * @return array|false
     */
    public function listarPessoa()
    {
        return DbModel::listaPublicado('pessoas');
    }

    /**
     * <p>Recupera pessoa através do id</p>
     * @param int|string $id
     * @return false|mixed|object
     */
    public function recuperarPessoa($id)
    {
        return $this->getInfo('pessoas', $this->decryption($id))->fetchObject();
    }

}
