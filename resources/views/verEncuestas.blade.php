<!--Autor: Beatriz-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script> 
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <script type = "text/javascript">
            $(function () {
            var alumno;
            var listado = [];
            var id_mo = '<?php echo $id_mo[0]->id; ?>';
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'encuestaPrim',
                    data: {'id_mo': id_mo},
                    type: 'POST',
                    success: function (respuesta) {
                    var datos = JSON.parse(respuesta);
                    listado.length = 0;
                    for (var d in datos['listado']) {
                    listado.push(datos['listado'][d].IdAlumno);
                    }
                    alumno = datos['encuesta1'][0].IdAlumno;
                    for (var d in datos['encuesta1']){
                    if (datos['encuesta1'][d].pregunta === '(opcional)') {
                    var opcional = datos['opcional'];
                    } else{
                    var opcional = datos['encuesta1'][d].pregunta;
                    }
                    $("#encuesta").append('<div class="row">\n\
                    <input class="col-1" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input class="col-8" type="text" value="' + opcional + '">\n\
                    <input class="col-3" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }

                    $("#anterior").append('<button>Anterior</button>');
                    $("#siguiente").append('<button>Siguiente</button>');
                    }
            });
            $("#siguiente").click(function () {
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'encuestaSig',
                    data: {'id_mo': id_mo, 'alumno':alumno, 'listado':listado},
                    type: 'POST',
                    success: function (respuesta) {
                    $("#encuesta div").remove();
                    var datos = JSON.parse(respuesta);
                    alumno = datos['encuesta1'][0].IdAlumno;
                    for (var d in datos['encuesta1']){
                    if (datos['encuesta1'][d].pregunta === '(opcional)') {
                    var opcional = datos['opcional'];
                    } else{
                    var opcional = datos['encuesta1'][d].pregunta;
                    }
                    $("#encuesta").append('<div class="row">\n\
                    <input class="col-1" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input class="col-8" type="text" value="' + opcional + '">\n\
                    <input class="col-3" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }
                    }
            });
            });
            $("#anterior").click(function () {
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'encuestaAnt',
                    data: {'id_mo': id_mo, 'alumno':alumno, 'listado':listado},
                    type: 'POST',
                    success: function (respuesta) {
                    $("#encuesta div").remove();
                    var datos = JSON.parse(respuesta);
                    alumno = datos['encuesta1'][0].IdAlumno;
                    for (var d in datos['encuesta1']){
                    if (datos['encuesta1'][d].pregunta === '(opcional)') {
                    var opcional = datos['opcional'];
                    } else{
                    var opcional = datos['encuesta1'][d].pregunta;
                    }
                    $("#encuesta").append('<div class="row">\n\
                    <input class="col-1" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input class="col-8" type="text" value="' + opcional + '">\n\
                    <input class="col-3" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }
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
            </table>
            <div class="row">
                <div id="encuesta"class="col-12">
                </div>
                <div class="row">
                    <div id="anterior" class="col-6"></div>
                    <div id="siguiente" class="col-6"></div>
                </div>
            </div>
        </div>
    </body>
</html>
