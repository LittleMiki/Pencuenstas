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
    <body class="container-fluid">
        @include('header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Login</a></li>
                <li class="breadcrumb-item"><a href="atras">Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Resumen Profesor</li>
            </ol>
        </nav>
        <div class="row pt-5">
            <div class="col-3"></div>
            <table class="col-6 table text-center" style="background-color: #c4cccf">
                <?php
                echo ('<tr><th>Grupo</th><td>' . $grupo[0]->curso . " " . $grupo[0]->grupo . " " . $grupo[0]->descripcion . '</td></tr>');
                echo('<tr><th>Asignatura</th><td>' . $materia . '</td></tr>');
                echo('<tr><th>Total Encuestados</th><td>' . $total_encuestas . '</td></tr>');
                ?>
                <tr><th>Fecha</th><td><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?></td></tr>
            </table>
            <div class="col-3"></div>
        </div>
        <?php if ($total_encuestas === 0) { ?>
            <p class="text-center">No existen datos</p>
            <?php
        } else {
            ?>
            <div class="row pt-2">
                <div class="col-1"></div>
                <table class="col-10 table table-primary table-bordered table-hover table-condensed text-center"><!--style="background-color: #c4cccf"-->
                    <thead>
                        <tr>
                            <th>Encuesta/Pregunta</th>
                            <?php
                            foreach ($preguntas as $p) {
                                echo('<th>' . $p->orden . '</th>');
                            }
                            ?>
                            <th>Media</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($tabla as $t) {
                            $e;
                            if (empty($e)) {
                                echo('<tr><td>' . $t->IdAlumno . '</td>');
                                echo('<td>' . $t->valor . '</td>');
                                $e = $t->IdAlumno;
                            } else if ($t->IdAlumno !== $e || $t === end($tabla)) {
                                if ($t === end($tabla)) {
                                    echo('<td>' . $t->valor . '</td>');
                                    echo('<td>' . $mediaEncuesta[$i] . '</td>');
                                } else {
                                    echo('<td>' . $mediaEncuesta[$i] . '</td>');
                                    echo('<tr><td>' . $t->IdAlumno . '</td>');
                                    echo('<td>' . $t->valor . '</td>');
                                    $e = $t->IdAlumno;
                                }
                                $i++;
                            } else {
                                echo('<td>' . $t->valor . '</td>');
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr><th>Media</th>
                            <?php
                            foreach ($mediaPreguntas as $m) {
                                echo('<td>' . $m . '</td>');
                            }
                            echo('<td>' . $mediaEncuesta[$i] . '</td>');
                            ?>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-1"></div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-4"></div>
            <a class="col-4 text-center" href="atras"><input class="text-center btn btn-danger" type="button" value="Volver"></a>
            <div class="col-4"></div>
        </div>
        <div class="row p-5"></div>
        @include('footer')
    </body>
</html>