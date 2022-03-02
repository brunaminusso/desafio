<?php
$url = SERVERURL.'api/verificadorEmail.php';

require_once "./controllers/UsuarioController.php";
$UsuarioObj = new UsuarioController();
?>
<div class="login-page">
    <div class="card w-50">
        <div class="card-header bg-dark">
            <a href="<?= SERVERURL ?>inicio" class="brand-link">
                <img src="<?= SERVERURL ?>views/dist/img/logocurso.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= NOMESIS ?></span>
            </a>
        </div>
        <div class="card-body register-card-body">
            <h5 class="login-box-msg">Cadastre-se</h5>
            <form class="formulario-ajax" data-form="save" action="<?= SERVERURL ?>ajax/usuarioAjax.php" method="post">
                <input type="hidden" name="_method" value="cadastraUsuario">
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome Completo: </label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefone">Telefone: </label>
                        <input type="text" id="telefone" name="telefone" class="form-control" onkeyup="mascara( this, mtel );" required maxlength="15">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="email">E-mail: </label>
                        <input type="email" class="form-control" name="email" required id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Insira sua senha *</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                        <div class="invalid-feedback">
                            <strong>Insira sua Senha</strong>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="cadastra">Cadastrar</button>
                </div>
                <div class="resposta-ajax">
                </div>
            </form>

            <div class="mb-0 text-center">
                <a href="<?= SERVERURL ?>" class="text-center">Já possuo cadastro</a>
            </div>
        </div>
        <div class="card-footer bg-light-gradient text-center">
            <img src="<?= SERVERURL ?>views/dist/img/CULTURA_HORIZONTAL_pb_positivo.png" alt="logo cultura">
        </div>
    </div><!-- /.card -->
</div>
