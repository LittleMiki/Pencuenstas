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
                    if (datos['encuesta1'][d].pregunta === 'Lo que se ha hecho bien' || datos['encuesta1'][d].pregunta === 'Lo que se puede mejorar') {
                    $("#encuesta").append('<div class="row pb-3">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-3" type="text" value="' + datos['encuesta1'][d].pregunta + '">\n\
                    <textarea readonly="" class="col-8">' + datos['encuesta1'][d].valor + '"</textarea>\n\
                    </div>');
                    } else{
                    $("#encuesta").append('<div class="row pb-1">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-10" type="text" value="' + opcional + '">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }
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
                    if (datos['encuesta1'][d].pregunta === 'Lo que se ha hecho bien' || datos['encuesta1'][d].pregunta === 'Lo que se puede mejorar') {
                    $("#encuesta").append('<div class="row pb-3">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-3" type="text" value="' + datos['encuesta1'][d].pregunta + '">\n\
                    <textarea readonly="" class="col-8">' + datos['encuesta1'][d].valor + '"</textarea>\n\
                    </div>');
                    } else{
                    $("#encuesta").append('<div class="row pb-1">\n\
                    <input readonly="" class="col-1" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-10" type="text" value="' + opcional + '">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }
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
                    if (datos['encuesta1'][d].pregunta === 'Lo que se ha hecho bien' || datos['encuesta1'][d].pregunta === 'Lo que se puede mejorar') {
                    $("#encuesta").append('<div class="row pb-3">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-3" type="text" value="' + datos['encuesta1'][d].pregunta + '">\n\
                    <textarea readonly="" class="col-8">' + datos['encuesta1'][d].valor + '"</textarea>\n\
                    </div>');
                    } else{
                    $("#encuesta").append('<div class="row pb-1">\n\
                    <input readonly="" class="col-1" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-10" type="text" value="' + opcional + '">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }
                    }
                    }
            });
            });
            });
        </script>
    </head>
    <body class="container-fluid">
        @include('header')
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Login</a></li>
                <li class="breadcrumb-item"><a href="atras">Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Encuestas</li>
            </ol>
        </nav>
        <div class="row pt-5">
            <div class="col-2"></div>
            <table class="col-8 table text-center" style="background-color: #c4cccf">
                <?php
                echo('<tr><th>Curso</th><th>Grupo</th><th>Materia</th><th>Profesor</th><th>Fecha</th></tr>');
                echo('<tr><td>' . $grupo[0]->curso . '</td><td>' . $grupo[0]->grupo . '</td><td id="modulo">' . $materia . '</td><td>' . $grupo[0]->nombre . '</td><td>' . date("d") . "/" . date("m") . "/" . date("Y") . '</td></tr>');
                ?>
            </table>
            <div class="col-2"></div>
        </div>
        <div class="row pt-3">
            <div class="col-2"></div>
            <div id="encuesta"class="col-8">
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-3 text-center">
            <div class="col-5"></div>
            <div id="anterior" class="col-1 text-center"></div>
            <div id="siguiente" class="col-1 text-center"></div>
            <div class="col-5"></div>
        </div>
        <div class="row p-5"></div>
        @include('footer')
    </body>
</html>
