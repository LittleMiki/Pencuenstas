<!--Autor: Beatriz-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script> 
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    </head>
    <body class="container">
        <div class="row">
            <table class="col-12 table text-center" style="background-color: #c4cccf">
                <?php
                echo ('<tr><th>Grupo</th><td>' . $grupo[0]->curso . " " . $grupo[0]->grupo . " " . $grupo[0]->descripcion . '</td></tr>');
                echo('<tr><th>Asignatura</th><td>' . $materia . '</td></tr>');
                echo('<tr><th>Total Encuestados</th><td>' . $total_encuestas . '</td></tr>');
                ?>
                <tr><th>Fecha</th><td><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?></td></tr>

            </table>
        </div>
        <?php if ($total_encuestas === 0) { ?>
            <p> no existen datos</p>
            <?php
        } else {
            ?>
            <div class="row">
                <table class="col-11 table text-center" style="background-color: #c4cccf">
                    <tr><th>Encuesta/Pregunta</th>
                        <?php
                        foreach ($preguntas as $p) {
                            echo('<th>' . $p->orden . '</th>');
                        }
                        ?>
                    </tr>
                    <?php
                    foreach ($tabla as $t) {
                        $e;
                        if (empty($e)) {
                            echo('<tr><td>' . $t->IdAlumno . '</td>');
                            echo('<td>' . $t->valor . '</td>');
                            $e = $t->IdAlumno;
                        } else if ($t->IdAlumno !== $e || $t === end($tabla)) {
                            if ($t === end($tabla)) {
                                echo('<td>' . $t->valor . '</td>');
                            } else {
                                echo('<tr><td>' . $t->IdAlumno . '</td>');
                                echo('<td>' . $t->valor . '</td>');
                                $e = $t->IdAlumno;
                            }
                        } else {
                            echo('<td>' . $t->valor . '</td>');
                        }
                    }
                    ?>
                    <tr><th>Media</th>
                        <?php
                        foreach ($mediaPreguntas as $m) {
                            echo('<td>' . $m . '</td>');
                        }
                        ?>
                    </tr>
                </table>
                <table class="col-1 table text-center" style="background-color: #c4cccf">
                    <tr><th>Media</th></tr>
                    <?php
                    foreach ($mediaEncuesta as $m) {
                        echo('<tr><td>' . $m . '</td></tr>');
                    }
                    ?>
                </table>
            <?php } ?>
        </div>
    </body>
</html>