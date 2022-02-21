<?php

use App\Class\Redireccion;

$inputs = $controlador->htmlInputFormulario;
$llave = $controlador->llaveFormulario;

?>
<br>
<h3>Cambiar Contraseña</h3>
<br>

<?php  $rutaPOST = Redireccion::obtener('Password','cambiarPasswordBd',SESSION_ID); ?>
<form id="cambiarPassword" autocomplete="off" role="form" method="POST" action="<?= $rutaPOST  ?>" >
    <div class="row">
        <?php
            foreach ($inputs as $input) {
                echo $input;
            }
        ?>
        <div class="col-12"></div>
        <div class="col-md-4">
            <button  name="<?= $llave ?>" class="btn btn-default btn-main btn-block  btn-flat btn-sm">cambiar contraseña</button>
        </div>
    </div>
</form>