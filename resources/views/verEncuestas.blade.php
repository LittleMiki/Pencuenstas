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
            var alumno; //en esta variable guardaremos el nombre del alumno al que pertenece la encuesta que esta pintada actualmente
            var listado = []; // en este vector guardaremos el listado de todos los alumnos que han hecho encuesta, es decir cada uno corresponde a una encuesta diferente
            var id_mo = '<?php echo $id_mo[0]->id; ?>'; //modulo de las encuestas que mostraremos

            //al empezar mostraremos la primera encuesta existente
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'encuestaPrim',
                    data: {'id_mo': id_mo}, //pasamos el modulo
                    type: 'POST',
                    success: function (respuesta) {
                    var datos = JSON.parse(respuesta);
                    listado.length = 0;
                    //recogemos el vector con el listado de alumnos, lo recorremos y lo guardamos en el vector local listado
                    for (var d in datos['listado']) {
                    listado.push(datos['listado'][d].IdAlumno);
                    }
                    alumno = datos['encuesta1'][0].IdAlumno; //guardamos el alumno de la encuesta actual en la variable local alumno


                    //recorremos la encuesta y la vamos pintando segun la pregunta que sea
                    for (var d in datos['encuesta1']){

                    //si la pregunta es la opcional creo una variable con esa pregunta
                    if (datos['encuesta1'][d].pregunta === '(opcional)') {
                    var opcional = datos['opcional'];
                    //si no es la opcional guardo tambien la pregunta en la variable opcional
                    } else{
                    var opcional = datos['encuesta1'][d].pregunta;
                    }
                    //si es la pregunta 5 o 6 pintamos los textareas correspondientes
                    if (datos['encuesta1'][d].pregunta === 'Lo que se ha hecho bien' || datos['encuesta1'][d].pregunta === 'Lo que se puede mejorar') {
                    $("#encuesta").append('<div class="row pb-3">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-3" type="text" value="' + datos['encuesta1'][d].pregunta + '">\n\
                    <textarea readonly="" class="col-8">' + datos['encuesta1'][d].valor + '"</textarea>\n\
                    </div>');
                    //tanto si son preguntas estáticas o la pregunta opcional ,pintamos con la variable opcional que contrendra la pregunta 
                    } else{
                    $("#encuesta").append('<div class="row pb-1">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].orden + '">\n\
                    <input readonly="" class="col-10" type="text" value="' + opcional + '">\n\
                    <input readonly="" class="col-1 text-center" type="text" value="' + datos['encuesta1'][d].valor + '">\n\
                    </div>');
                    }
                    }

                    $("#anterior").append('<button class="btn btn-dark">Anterior</button>');
                    $("#siguiente").append('<button class="btn btn-dark">Siguiente</button>');
                    }
            });
            $("#siguiente").click(function () {//si pinchamos el boton de siguiente
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'encuestaSig',
                    data: {'id_mo': id_mo, 'alumno':alumno, 'listado':listado},//pasamos los datos de la encuesta que hay pintada en ese momento
                    type: 'POST',
                    success: function (respuesta) {
                    $("#encuesta div").remove();//borramos si existe una encuesta anterior
                    var datos = JSON.parse(respuesta);
                    alumno = datos['encuesta1'][0].IdAlumno;//guardamos en alumno de la encuesta que pintaremos ahora
                    //recorremos el vector de preguntas igual que en el anterior
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
            $("#anterior").click(function () {//al pulsar el boton anterior
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'encuestaAnt',
                    data: {'id_mo': id_mo, 'alumno':alumno, 'listado':listado},//pasamos los datos de la encuesta que hay pintada en ese momento
                    type: 'POST',
                    success: function (respuesta) {
                    $("#encuesta div").remove();
                    var datos = JSON.parse(respuesta);
                    alumno = datos['encuesta1'][0].IdAlumno;//guardamos el alumno de la encuesta que pintaremos
                    //y pintamos la encuesta
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
        <div class="row pt-4">
            <div class="col-4"></div>
            <a class="col-4 text-center" href="atras"><input class="text-center btn btn-danger" type="button" value="Volver"></a>
            <div class="col-4"></div>
        </div>
        <div class="row p-5"></div>
        @include('footer')
    </body>
</html>
