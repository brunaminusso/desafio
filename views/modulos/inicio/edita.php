<?php
$id = $_SESSION['usuario_id_g'];

require_once "./controllers/UsuarioController.php";
$objUsuario = new UsuarioController();
$usuario = $objUsuario->recuperaUsuario($id)->fetch();


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

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Dados pessoais</h3>
                    </div>
                    <div class="card-body register-card-body">
                        <form class="form-horizontal formulario-ajax" method="POST" action="<?=SERVERURL?>ajax/usuarioAjax.php" role="form" data-form="update">
                        <input type="hidden" name="_method" value="editaUsuario">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome: </label>
                                <input type="text" class="form-control" id="nome" name="nome" maxlength="120" value="<?=$usuario['nome']?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="email">E-mail: </label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="120" value="<?=$usuario['email']?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telefone">Telefone: </label>
                                <input type="text" data-mask="(00) 00000-0000" class="form-control" id="telefone" name="telefone" maxlength="15" onkeyup="mascara( this, mtel );" value="<?=$usuario['telefone']?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-block">Gravar</button>
                    </div>
                    <div class="resposta-ajax">
                    </div>
                        </form>
                </div>
            </div>
                <!-- /.card -->

            <!-- /.col -->
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Trocar senha</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body register-card-body">
                        <form class="needs-validation formulario-ajax" data-form="update" action="<?=SERVERURL?>ajax/usuarioAjax.php" method="post">
                        <input type="hidden" name="_method" value="trocaSenha">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="senha">Senha: *</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-block">Trocar</button>
                    </div>
                    <div class="resposta-ajax">
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>