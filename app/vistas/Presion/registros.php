<?php
$registros = $controlador->registros;
?><br>
<?php foreach ($registros as $registro) : ?>
    <div align="center" >
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text text-center"><?= $registro['sistolica']; ?>/<?= $registro['diastolica']; ?></p>
                <p class="card-text text-center"><?= $registro['bpm']; ?> bpm</p>
                <p class="card-text text-center"><?= date("d-m-Y", strtotime($registro['fecha']));; ?> <?= $registro['hora']; ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>