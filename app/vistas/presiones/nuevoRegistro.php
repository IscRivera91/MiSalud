<?php

    use App\ayudas\Redireccion;

    $requiredClases = "required class='form-control  form-control-lg'";
    $fecha = date('Y-m-d');
    $hora = date("H:i:s");
?>
<br>
<form autocomplete="off" role="form" method="POST"
      action="<?php echo Redireccion::obtener('presiones','registrarBd',SESSION_ID) ?>">
    <div class="row">
        <div class=col-md-3>
            <div class='input-group mb-3'>
                <input title='Sistolica' name='sistolica' placeholder='Sistolica' <?= $requiredClases; ?> type='number'>
            </div>
        </div>
        <div class='col-md-12'></div>
        <div class=col-md-3>
            <div class='input-group mb-3'>
                <input title='Diastolica' name='diastolica' placeholder='Diastolica' <?= $requiredClases; ?> type='number'>
            </div>
        </div>
        <div class='col-md-12'></div>
        <div class=col-md-3>
            <div class='input-group mb-3'>
                <input title='Latidos por minuto' name='bpm' placeholder='Latidos por minuto' <?= $requiredClases; ?> type='number'>
            </div>
        </div>
        <div class='col-md-12'></div>
        <div class=col-md-3>
            <div class='input-group mb-3'>
                <input title='Fecha' value="<?= $fecha; ?>" name='fecha' placeholder='Fecha' <?= $requiredClases; ?> type='date'>
            </div>
        </div>
        <div class='col-md-12'></div>
        <div class=col-md-3>
            <div class='input-group mb-3'>
                <input title='Hora' value="<?= $hora; ?>" step="2" name='hora' placeholder='Hora' <?= $requiredClases; ?> type='time'>
            </div>
        </div>
        <div class='col-md-12'></div>
        <div class=col-md-3>
            <div class='form-group'>
                <button type='submit' name='<?= md5(SESSION_ID) ?>' class='btn btn-default btn-argus btn-block  btn-flat btn-lg'>Registrar</button>
            </div>
        </div>

    </div>
</form>

