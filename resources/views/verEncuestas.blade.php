<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script> 
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <script type = "text/javascript">
            $(function () {
            $().ready(function () {


            });
            });
        </script>
    </head>
    <body class="container">
        <div class="row">
            <table class="col-12 table text-center" style="background-color: #c4cccf">
                <?php
                echo ('<tr><th>Grupo</th><td>' . $grupo[0]->curso . " " . $grupo[0]->grupo . " " . $grupo[0]->nombre . '</td></tr>');
                echo('<tr><th>Asignatura</th><td>' . $materia . '</td></tr>');
                ?>
                <tr><th>Fecha</th><td><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?></td></tr>

            </table>
        </div>
    </body>
</html>
