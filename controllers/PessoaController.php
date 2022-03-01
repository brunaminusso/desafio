<?php
/* @var $pedidoAjax */
if ($pedidoAjax) {
    require_once "../models/PessoaModel.php";
} else {
    require_once "./models/PessoaModel.php";
}

class PessoaController extends PessoaModel
{
    /**
     * <p>Cadastro de pessoa</p>
     * @return string
     */
    public function cadastrarPessoa(): string
    {
        $dadosLimpos = PessoaModel::limparStringPS($_POST);

        $insere = DbModel::insert('pessoas', $dadosLimpos['ps']);
        if ($insere->rowCount() > 0) {
            $id = DbModel::connection()->lastInsertId();

            if (isset($dadosLimpos['cp'])) {
                if (count($dadosLimpos['cp']) > 0) {
                    $dadosLimpos['cp']['pessoa_fisicas_id'] = $id;
                    DbModel::insert('cursos_pessoas', $dadosLimpos['cp']);
                }
            }

            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Pessoa cadastrada!',
                'texto' => 'Dados cadastrados com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . "pessoa_cadastro&id=" . MainModel::encryption($id)
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
    public function editarPessoa($dados, $id): string
    {
        unset($dados['_method']);
        unset($dados['id']);
        $id = MainModel::decryption($id);

        $dadosLimpos = PessoaModel::limparStringPS($_POST);

        $update = DbModel::update('pessoas', $dadosLimpos['ps'], $id);

        if ($update->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {

            if (isset($dadosLimpos['cp'])) {
                if (count($dadosLimpos['cp']) > 0) {
                    $banco_existe = DbModel::consultaSimples("SELECT * FROM cursos_pessoas WHERE pessoa_fisicas_id = '$id'");
                    if ($banco_existe->rowCount() > 0) {
                        DbModel::updateEspecial('cursos_pessoas', $dadosLimpos['cp'], "pessoa_fisicas_id", $id);
                    } else {
                        $dadosLimpos['cp']['pessoa_fisicas_id'] = $id;
                        DbModel::insert('cursos_pessoas', $dadosLimpos['cp']);
                    }
                }
            }

            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Pessoa alterado com sucesso!',
                'texto' => 'Dados alterados com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . "pessoa/pessoa_cadastro&id=" . MainModel::encryption($id)
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
    public function apagarPessoa($id): string
    {
        $apagar = $this->apaga("pessoas", $id);
        if ($apagar->rowCount() >= 1) {
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
        return DbModel::consultaSimples("SELECT 
                                                 ps.id, 
                                                 ps.nome, 
                                                 ps.email,   
                                                 ps.telefone, 
                                                 cr.nome AS 'curso'
                                                 FROM pessoas AS ps
                                                 INNER JOIN cursos_pessoas AS cp ON ps.id = cp.pessoa_fisicas_id
                                                 INNER JOIN cursos AS cr ON cp.cursos_id = cr.id       
                                                 WHERE ps.publicado = 1 AND cr.publicado = 1")->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * <p>Recupera pessoa através do id</p>
     * @param int|string $id
     * @return false|mixed|object
     */
    /*public function recuperarPessoa($id)
    {
        return $this->getInfo('pessoas', $this->decryption($id))->fetchObject();
    }*/

    /**
     * <p>Recupera os dados da pessoa</p>
     * @param int|string $id
     * @return false|mixed|object
     */
    public function recuperarPessoa($id)
    {
        $id = parent::decryption($id);
        return $this->consultaSimples("SELECT 
                                               ps.*,
                                               cp.*,     
                                               cr.nome AS 'curso'
                                               FROM pessoas ps
                                               INNER JOIN cursos_pessoas AS cp ON ps.id = cp.pessoa_fisicas_id
                                               INNER JOIN cursos AS cr ON cp.cursos_id = cr.id 
                                               WHERE ps.id = '$id'
                                               ")->fetchObject();
    }

}