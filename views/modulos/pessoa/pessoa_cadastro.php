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
                <h1 class="m-0 text-dark">Cadastro de pessoas</h1>
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
                        <h3 class="card-title">Dados</h3>
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
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome: </label>
                                    <input type="text" class="form-control" id="nome" name="nome" maxlength="120" value="<?= $pessoa->nome ?? null ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email: </label>
                                    <input type="text" class="form-control" id="email" name="email" maxlength="120" value="<?= $pessoa->email ?? null ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="data_nascimento">Data de nascimento: </label>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= $pessoa->data_nascimento ?? null ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefone">Telefone: </label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" maxlength="11" onkeyup="mascara( this, mtel )" value="<?= $pessoa->telefone ?? null ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="curso_id">Curso: </label>
                                    <select class="form-control select2bs4" id="curso_id" name="su_curso_id" required>
                                        <option value="">Selecione uma opção...</option>
                                        <?php $pessoaObj->geraOpcao("cursos",$pessoa->curso_id ?? null); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="<?= SERVERURL ?>pessoa_lista">
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