<?php 
    $registros = $controlador->registros;
?>
<?php foreach ($registros as $registro) : ?>
    <div align="center" >
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text text-center"><?= $registro['presiones_sistolica']; ?>/<?= $registro['presiones_diastolica']; ?></p>
                <p class="card-text text-center"><?= $registro['presiones_bpm']; ?> bpm</p>
                <p class="card-text text-center"><?= date("d-m-Y", strtotime($registro['presiones_fecha']));; ?> <?= $registro['presiones_hora']; ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>