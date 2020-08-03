<!doctype html>
<html lang="es">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/gif" href="img/favicon.ico"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="adminlte3/fontawesome-free/css/all.min.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="adminlte3/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="adminlte3/select2/css/select2.min.css">
        <link rel="stylesheet" href="adminlte3/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="adminlte3/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="css/argus.css">
        <?php 
            $rutaArchivoCss = '';
            if (isset($controladorActual) && isset($metodoActual)) {
                $rutaArchivoCss = "css/{$controladorActual}.{$metodoActual}.css";
            }
            if(file_exists($rutaArchivoCss)) {
                echo "<link rel='stylesheet' href='{$rutaArchivoCss}'>";
            }
        ?>
        <title><?= NOMBRE_PROYECTO ?></title>
    </head>