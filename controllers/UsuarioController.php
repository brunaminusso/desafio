<?php
/** @var $pedidoAjax */
if ($pedidoAjax) {
    require_once "../models/UsuarioModel.php";
} else {
    require_once "./models/UsuarioModel.php";
}

class UsuarioController extends UsuarioModel
{
    /** <p>Para logar no sistema</p>
     * @param $modulo
     * @param $edital
     * @return string
     */
    public function iniciaSessao($modulo = false, $edital = null)
    {
        $email = MainModel::limparString($_POST['usuario']);
        $senha = MainModel::limparString($_POST['senha']);
        $senha = MainModel::encryption($senha);

        $dadosLogin = [
            'usuario' => $email,
            'senha' => $senha
        ];

        $consultaUsuario = UsuarioModel::getUsuario($dadosLogin);

        if ($consultaUsuario->rowCount() == 1) {
            $usuario = $consultaUsuario->fetch();
            session_start(['name' => 'curso']);
            $_SESSION['login_g'] = $usuario['email'];
            $_SESSION['nome_g'] = $usuario['nome'];
            $_SESSION['usuario_id_g'] = $usuario['id'];

            if (!$modulo) {
                return $urlLocation = "<script> window.location='inicio/inicio' </script>";
            } else {
                if ($modulo != NULL) {
                    $_SESSION['edital_g'] = $edital;
                    return $urlLocation = "<script> window.location='inicio&modulo=$modulo' </script>";
                }
            }
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Usuário / Senha incorreto',
                'tipo' => 'error'
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    /**
     * <p>Para deslogar do sistema</p>
     * @return void
     */
    public function forcarFimSessao()
    {
        session_destroy();
        return header("Location: ".SERVERURL);
    }

    /**
     * <p>Retorna os dados do usuário</p>
     * @param $id
     * @return bool|PDOStatement
     */
    public function recuperaUsuario($id)
    {
        return DbModel::getInfo('usuario',$id);
    }

    /**
     * <p>Cadastra um novo usuario</p>
     * @return string
     */
    public function cadastrar($dados)
    {
        unset($dados['_method']);
        $dados = MainModel::limpaPost($dados);
        $dados['senha'] = MainModel::encryption($dados['senha']);

        $insert = DbModel::insert("usuario", $dados);
        if ($insert->rowCount() >= 1) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Usuário Cadastrado!',
                'texto' => 'Dados cadastrados com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . 'login'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Oops! Algo deu Errado!',
                'texto' => 'Falha ao salvar os dados no servidor, tente novamente mais tarde',
                'tipo' => 'error',
                'location' => SERVERURL . 'login'
            ];
        }

        return MainModel::sweetAlert($alerta);
    }

    /**
     * <p>Edita os dados do usuário</p>
     * @param $dados
     * @param $id
     * @return string
     */
    public function editar($dados, $id){
        unset($dados['_method']);
        unset($dados['id']);
        $dados = MainModel::limpaPost($dados);
        $edita = DbModel::update('usuario', $dados, $id);
        if ($edita) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Usuário',
                'texto' => 'Informações alteradas com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL.'inicio/edita'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL.'inicio/edita'
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    /**
     * <p>Troca a senha do usuário</p>
     * @param $dados
     * @param $id
     * @return string
     */
    public function trocaSenha($dados,$id){
        unset($dados['_method']);
        $dados = MainModel::limpaPost($dados);
        $dados['senha'] = MainModel::encryption($dados['senha']);
        $edita = DbModel::update('usuario', $dados, $id);
        if ($edita) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Usuário',
                'texto' => 'Senha alterada com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL.'inicio/edita'
            ];
        }
        else{
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL.'inicio/edita'
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

}
