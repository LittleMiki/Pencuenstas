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
            var modulo = $("#modulo").val();
            alert(modulo);
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'verEncuesta',
                    data: {'modulo':modulo},
                    type: 'POST',
                    success: function (respuesta) {
//                    var datos = JSON.parse(respuesta);

                    }
            });
            });
            });
        </script>
    </head>
    <body class="container">
        <div class="row">
            <table class="col-12 table text-center" style="background-color: #c4cccf">
                <?php
                echo('<tr><th>Curso</th><th>Grupo</th><th>Materia</th></tr>');
                echo('<tr><td>' . $grupo[0]->curso . '</td><td>' . $grupo[0]->grupo . '</td><td id="modulo">' . $materia . '</td></tr>');
                echo('<tr><th>Profesor/a</th><td>' . $grupo[0]->nombre . '</td><th>Fecha</th><td>' . date("d") . "/" . date("m") . "/" . date("Y") . '</td></tr>');
                ?>
                <!--<th>Fecha</th><td>--><?php // echo date("d") . "/" . date("m") . "/" . date("Y");         ?> <!--</td></tr>-->
            </table>
        </div>
    </body>
</html>
