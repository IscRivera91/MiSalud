<?php $teme = "bootstrap4"; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="adminlte3/jquery/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="adminlte3/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="adminlte3/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="adminlte3/bootstrap/js/bootstrap.min.js"></script>
    <script src="adminlte3/dist/js/adminlte.min.js"></script>
    <script src="js/argus.js"></script>
    <script>
        $(function () {

            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: '<?= $teme ?>'
            });
        });
    </script>
    <?php 
        $rutaArchivoJs = '';
        if (isset($controladorActual) && isset($metodoActual)) {
            $rutaArchivoJs = "js/{$controladorActual}.{$metodoActual}.js";
        }
        if(file_exists($rutaArchivoJs)) {
            echo "<script src='$rutaArchivoJs'></script>";
        }
    ?>
    </body>
</html>