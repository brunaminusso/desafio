<div class="row">
    <!-- Default to the left -->
    <div class="col text-left">2019 - <?= date('Y') ?> - Desenvolvido por SMC / STI - Sistemas de Informação
        <div class="box-group" id="accordion">
            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseRodape">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseRodape" class="panel-collapse collapse">
                    <div class="box-body">
                        <?php
                        echo "<strong>SESSION</strong><pre>", var_dump($_SESSION), "</pre>";
                        echo "<strong>POST</strong><pre>", var_dump($_POST), "</pre>";
                        echo "<strong>GET</strong><pre>", var_dump($_GET), "</pre>";
                        echo "<strong>FILES</strong><pre>", var_dump($_FILES), "</pre>";
                        echo "<strong>SERVER</strong><pre>", var_dump($_SERVER), "</pre>";
                        echo ini_get('session.gc_maxlifetime') / 60; // em minutos
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- To the right -->
    <div class="col text-right">
        <img src="<?= SERVERURL ?>views/dist/img/CULTURA_HORIZONTAL_pb_positivo.png">
    </div>
</div>
