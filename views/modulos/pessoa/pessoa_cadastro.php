<?php
require_once "./controllers/PessoaController.php";
$pessoaObj = new PessoaController();

$id = $_GET['id'] ?? null;

if ($id){
    $pessoa = $pessoaObj->recuperarPessoa($id);
}

?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= ($id) ? 'Edição de pessoa' : 'Cadastro de pessoa' ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/pessoaAjax.php" role="form" data-form="<?= ($id) ? "update" : "save" ?>">
                    <input type="hidden" name="_method" value="<?= ($id) ? "editaPessoa" : "cadastraPessoa" ?>">
                    <?php if ($id): ?>
                        <input type="hidden" name="id" value="<?= $id ?>">
                    <?php endif; ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="ps_nome">Nome: </label>
                                    <input type="text" class="form-control" id="nome" name="ps_nome" maxlength="120" value="<?= $pessoa->nome ?? null ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ps_data_nascimento">Data de nascimento: </label>
                                    <input type="date" class="form-control" id="ps_data_nascimento" name="ps_data_nascimento" value="<?= $pessoa->data_nascimento ?? null ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="ps_email">Email: </label>
                                    <input type="text" class="form-control" id="email" name="ps_email" maxlength="120" value="<?= $pessoa->email ?? null ?>" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ps_telefone">Telefone: </label>
                                    <input type="text" class="form-control" id="telefone" name="ps_telefone" maxlength="15" onkeyup="mascara( this, mtel )" value="<?= $pessoa->telefone ?? null ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="curso">Curso:</label>
                                    <select id="cursos_id" name="cp_cursos_id" required class="form-control select2bs4">
                                        <option value="">Selecione uma opção...</option>
                                        <?php $pessoaObj->geraOpcao("cursos",$pessoa->cursos_id ?? NULL)?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="<?= SERVERURL ?>pessoa/pessoa_lista">
                                <button type="button" class="btn btn-default pull-left">Voltar</button>
                            </a>
                            <button type="submit" class="btn btn-info float-right">Gravar</button>
                        </div>
                        <!-- /.card-footer -->
                        <div class="resposta-ajax"></div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>