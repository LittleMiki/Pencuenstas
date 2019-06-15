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


//Autor: Miguel Angel//
            $(function () {
            var parametros = {"tipo": '<?php echo $tipo; ?>',
                    "nombre": '<?php echo $nombre; ?>'};
            $().ready(function () {


            //          alert(com);

            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'miJqueryAjax',
                    type: 'POST',
                    data: parametros,
                    //data: {"compuesto" :$(this).val() },
                    success: function (response) {
                    // alert(response);
                    var txt = '<option></option>';
                    var datos = JSON.parse(response);
                    for (x in datos) {
                    txt = txt + '<option>' + datos[x].descripcion + '</option>';
                    }
                    $("#materias").html(txt);
                    },
                    statusCode: {
                    404: function () {
                    alert('web not found');
                    }
                    },
                    error: function (x, xs, xt) {

                    window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                    }
            });
            }).keyup();
////////////////////////////////////////////////////////////////////////////////



            //Autor: Beatriz//
            $("#materias").change(function () {
            var modulo = $("#materias").val();
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'mostrarEncuesta',
                    data: {'modulo': modulo},
                    type: 'POST',
                    success: function (respuesta) {
                    var f = new Date();
                    var datos = JSON.parse(respuesta);
                    $("#formulario div").remove();
                    $("#formulario").append("\
                    <div class='col-lg-12'>\n\
                        <div class='row text-center pb-3'>\n\
                            <div class='col-lg-1'></div>\n\
                            <label class='col-lg-1 mt-1'>Profesor/a</label>\n\
                            <input class='col-lg-5' readonly type='text' name='nombre' value='" + datos.nombre[0].nombre + "'/>\n\
                            <div class='col-lg-1'></div>\n\
                            <label class='col-lg-1 mt-1'>Fecha</label>\n\
                            <input class='col-lg-2' id='fecha' type='datetime' disabled='' value='" + f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear() + "'>\n\
                            <div class='col-lg-1'></div>\n\
                        </div>\n\
                        <div class='row pt-3'>\n\
                            <div class='col-lg-1'></div>\n\
                            <div class='col-lg-10'>\n\
                                <table class='table text-center'>\n\
                                    <tr><td><h5>Valoración</h5></td></tr>\n\
                                    <tr><td><p>Expresa tu opinión respecto a las siguientes afirmaciones según esta escala</p></td></tr>\n\
                                    <tr><td><p><b>5 Mucho 4 Bastante 3 Neutral 2 Poco 1 Nada</b></p></td></tr>\n\
                                </table>\n\
                            </div>\n\
                            <div class='col-lg-1'></div>\n\
                        </div>\n\
                        <div class='row text-center' id='encuesta' ></div>\n\
                        <div class='row pt-4 pb-4 text-center' id='enviar'></div>\n\
                    </div>");
                    for (var p in datos.preguntas) {
                    if (datos.preguntas[p].orden === 4 || datos.preguntas[p].orden === 5 || datos.preguntas[p].orden === 6) {
                    if (datos.preguntas[p].orden == 4) {
                    $("#encuesta").append("\
                    <div class='col-lg-1'></div>\n\
                    <div class='col-lg-9 p-1 mb-2'><input name='p" + p + "' type='text' readonly value='Pregunta adicional:Formula la pregunta que introducirias para mejorar este cuestionario(valórala posteriormente).'>\n\
                    <input type='text' name='opcional' value=''></div>\n\
                    <select class='col-lg-1 mb-2' name='respuestas[]'>\n\
                        <option>1</option>\n\
                        <option>2</option>\n\
                        <option>3</option>\n\
                        <option>4</option>\n\
                        <option>5</option>\n\
                    </select>\n\
                    <div class='col-lg-1'></div>");
                    }
                    if (datos.preguntas[p].orden === 5 || datos.preguntas[p].orden === 6){
                    $("#encuesta").append("<input class='col-lg-9 p-1 mb-2' name='p" + p + "' type='text' size='20' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
                        <textarea name='respuestas[]'></textarea>");
                    }
                    } else{
                    $("#encuesta").append("\
                    <div class='col-lg-1'></div>\n\
                    <input class='col-lg-9 p-1 mb-2' name='p" + p + "' type='text' size='40' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
                    <select class='col-lg-1 mb-2' name='respuestas[]'>\n\
                        <option>1</option>\n\
                        <option>2</option>\n\
                        <option>3</option>\n\
                        <option>4</option>\n\
                        <option>5</option>\n\
                    </select>\n\
                    <div class='col-lg-1'></div>");
                    }
                    }
                    $("#enviar").append("<div class='col-lg-5'></div><input class='col-lg-2 text-center' type='submit' name='enviar' value='Enviar'><div class='col-lg-5'></div>");
                    }
            });
            });
////////////////////////////////////////////////////////////////////////////////

            });

        </script>
    </head>
    <!--Autor: Beatriz-->
    <body class="container">
        @include('header')
        <div class="row pt-5 pb-3 " id="main">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <table class="table text-center m-3" style="background-color: #c4cccf">
                    <?php
                    echo ('<tr><th>Curso</th><td>' . $curso . '</td></tr>');
                    echo('<tr><th>Grupo</th><td>' . $grupo . '</td></tr>');
                    echo('<tr><th>Materia</th><td><select name="mat" id="materias"></select></td></tr>');
                    ?>
                </table>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <form class="row pt-5 pb-5" id='formulario' name='form' action='respuestas' method='POST'>
            {!! csrf_field(); !!}
        </form>
        @include('footer')
        <!--------------------------------------------------------------------->
    </body>
</html>