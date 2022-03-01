<?php
require_once "./controllers/CursoController.php";
$cursoObj = new CursoController();

$cursos = $cursoObj->listarCurso();
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-10">
                <h1 class="m-0 text-dark">Cursos</h1>
            </div><!-- /.col -->
            <div class="col-2">
                <a href="<?= SERVERURL ?>curso_cadastro" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Adicionar</a>
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
                                <th>Curso</th>
                                <th>Duração</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($cursos as $curso): ?>
                            <tr>
                                <td><?=$curso->nome ?></td>
                                <td><?=$curso->duracao ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <a href="<?= SERVERURL . "curso_cadastro&id=" . $cursoObj->encryption($curso->id) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                        </div>
                                        <div class="col-md">
                                            <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/cursoAjax.php" role="form" data-form="delete">
                                                <input type="hidden" name="_method" value="apagaCurso">
                                                <input type="hidden" name="id" value="<?= $curso->id ?>">
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
                                <th>Curso</th>
                                <th>Duração</th>
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