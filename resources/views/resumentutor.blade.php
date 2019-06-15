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
                echo('<tr><th>Tutor</th><td>' . $tutor . '</td></tr>');
                ?>
                <tr><th>Fecha</th><td><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?></td></tr>

            </table>
        </div>
        <div class="row">
            <table class="col-11 table text-center" style="background-color: #c4cccf">
                <tr><th>MÓDULO</th><th>¿EXISTEN ENCUESTAS?</th><th>ENCUESTAS REALIZADAS</th><th>CON VALOR >= 3</th></tr>

                <?php
//                echo($tabla[0]{'modulo'});
                foreach ($tabla as $t) {
                    echo('<tr><td>' . $t{'modulo'} . '</td><td>' . $t{'hay'} . '</td><td>' . $t{'total'} . '</td><td>' . $t{'aprobadas'} . '</td></tr>');
                }
                echo('<tr><td>TOTAL</td><td>' . $total{'total_modulos'} . '</td><td>' . $total{'total_realizadas'} . '</td><td>' . $total{'total_valor>=3'} . '</td></tr>');
                echo('<tr><td>CUMPLEN CRITERIO</td><td>' . $criterio . '</td><td></td><td></td></tr>');
                echo('<tr><td>% CUMPLIMIENTO</td><td>' . $cumplimiento{'%si'} . '%</td><td></td><td>' . $cumplimiento{'total'} . '%</td></tr>');
                ?>
            </table>
        </div>
    </body>
</html>