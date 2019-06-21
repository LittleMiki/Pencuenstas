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
        <div class="row pt-5">
            <div class="col-4"></div>
            <table class="col-4 table text-center border border-bottom border-left border-right border-top" style="background-color: #c4cccf">
                <?php
                echo ('<tr><th>Grupo</th><td>' . $grupo[0]->curso . " " . $grupo[0]->grupo . " " . $grupo[0]->descripcion . '</td></tr>');
                echo('<tr><th>Tutor</th><td>' . $tutor . '</td></tr>');
                ?>
                <tr><th>Fecha</th><td><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?></td></tr>
            </table>
            <div class="col-2"></div>
        </div>
        <div class="row pt-2">
            <div class="col-2"></div>
            <table class="col-8 table table-primary table-hover table-condensed text-center">
                <thead style="background-color:#34b3c8"><tr><th>MÓDULO</th><th>¿EXISTEN ENCUESTAS?</th><th>ENCUESTAS REALIZADAS</th><th>CON VALOR >= 3</th></tr></thead>
                <tbody>
                    <?php
                    foreach ($tabla as $t) {
                        echo('<tr><td>' . $t{'modulo'} . '</td><td>' . $t{'hay'} . '</td><td>' . $t{'total'} . '</td><td>' . $t{'aprobadas'} . '</td></tr>');
                    }
                    echo('<tr style="background-color:#34b3c8"><td><b>TOTAL</b></td><td><b>' . $total{'total_modulos'} . '</b></td><td><b>' . $total{'total_realizadas'} . '</b></td><td><b>' . $total{'total_valor>=3'} . '</b></td></tr>');
                    echo('<tr style="background-color:#34b3c8"><td><b>CUMPLEN CRITERIO</b></td><td><b>' . $criterio . '</b></td><td></td><td></td></tr>');
                    echo('<tr style="background-color:#34b3c8"><td><b>% CUMPLIMIENTO</b></td><td><b>' . $cumplimiento{'%si'} . '%</b></td><td></td><td><b>' . $cumplimiento{'total'} . '%</b></td></tr>');
                    ?>
                </tbody>
            </table>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <a class="col-4 text-center" href="atras"><input class="text-center btn btn-danger" type="button" value="Volver"></a>
            <div class="col-4"></div>
        </div>
        <div class="row p-5"></div>
        @include('footer')
    </body>
</html>