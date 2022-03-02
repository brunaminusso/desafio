<?php
require_once "./controllers/PessoaController.php";
$pessoaObj = new PessoaController();

$pessoas = $pessoaObj->listarPessoa();
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-10">
            </div><!-- /.col -->
            <div class="col-2">
                <a href="<?= SERVERURL ?>pessoa/pessoa_cadastro" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Adicionar</a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Listagem</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabela" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Curso</th>
                                <th style="width: 21%">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pessoas as $pessoa): ?>
                            <tr>
                                <td><?=$pessoa->nome ?></td>
                                <td><?=$pessoa->email ?></td>
                                <td><?=$pessoa->curso ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <a href="<?= SERVERURL . "pessoa/pessoa_cadastro&id=" . $pessoaObj->encryption($pessoa->id) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                        </div>
                                        <div class="col-md">
                                            <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/pessoaAjax.php" role="form" data-form="delete">
                                                <input type="hidden" name="_method" value="apagaPessoa">
                                                <input type="hidden" name="id" value="<?= $pessoa->id ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Excluir</button>
                                                <div class="resposta-ajax"></div>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Curso</th>
                                <th>Ação</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>