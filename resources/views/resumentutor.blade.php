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
                <li class="breadcrumb-item active" aria-current="page">Resumen Tutor</li>
            </ol>
        </nav>
        <div class="row pt-5">
            <div class="col-4"></div>
            <table class="col-4 table text-center" style="background-color: #c4cccf">
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
            <table class="col-8 table table-bordered table-hover table-condensed text-center" style="background-color: #c4cccf">
                <thead><tr><th>MÓDULO</th><th>¿EXISTEN ENCUESTAS?</th><th>ENCUESTAS REALIZADAS</th><th>CON VALOR >= 3</th></tr></thead>
                <tbody>
                    <?php
                    foreach ($tabla as $t) {
                        echo('<tr><td>' . $t{'modulo'} . '</td><td>' . $t{'hay'} . '</td><td>' . $t{'total'} . '</td><td>' . $t{'aprobadas'} . '</td></tr>');
                    }
                    echo('<tr><td>TOTAL</td><td>' . $total{'total_modulos'} . '</td><td>' . $total{'total_realizadas'} . '</td><td>' . $total{'total_valor>=3'} . '</td></tr>');
                    echo('<tr><td>CUMPLEN CRITERIO</td><td>' . $criterio . '</td><td></td><td></td></tr>');
                    echo('<tr><td>% CUMPLIMIENTO</td><td>' . $cumplimiento{'%si'} . '%</td><td></td><td>' . $cumplimiento{'total'} . '%</td></tr>');
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