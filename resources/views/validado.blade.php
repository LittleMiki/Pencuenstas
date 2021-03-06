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
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
            var modulo = $("#materias").val();//guardamos el modulo seleccionado
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                    url: 'mostrarEncuesta',
                    data: {'modulo': modulo},//pasamos el valor del modulo al controlador
                    type: 'POST',
                    success: function (respuesta) {
                    var f = new Date(); //creamos una variable con la fecha actual
                    var datos = JSON.parse(respuesta);
                    $("#formulario div").remove();//borramos si existe una encuesta ya pintada
                    
                    //pintamos la parte del nombre del profesor, la fecha y la informacion a seguir para realizar la encuesta
                    $("#formulario").append("\
                    <div class='col-lg-12'>\n\
                        <div class='row text-center pb-3'>\n\
                            <div class='col-lg-2'></div>\n\
                            <label class='col-lg-1'>Profesor/a</label>\n\
                            <input class='col-lg-4' readonly type='text' name='nombre' value='" + datos.nombre[0].nombre + "'/>\n\
                            <label class='col-lg-1 ml-1'>Fecha</label>\n\
                            <input class='col-lg-2'id='fecha' readonly type='datetime' value='" + f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear() + "'>\n\
                            <div class='col-lg-2'></div>\n\
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
                        <div class='row text-center'><div id='encuesta' class='col-lg-12'></div></div>\n\
                        <div class='row pt-4 text-center' id='enviar'></div>\n\
                    </div>");
                      
                      //recorremos el vector con las preguntas y las pintamos
                    for (var p in datos.preguntas) {
                        
                        //vamos pintando segun cual sea la pregunta, dado que las preguntas,4,5 y 6 seran diferentes
                    if (datos.preguntas[p].orden === 4 || datos.preguntas[p].orden === 5 || datos.preguntas[p].orden === 6) {
                    if (datos.preguntas[p].orden == 4) {
                    $("#encuesta").append("\
                    <div class='row pb-1 ml-1 mr-1'>\n\
                    <div class='col-lg-1'></div>\n\
                    <input class='col-lg-9 mb-2 bg-light' type='text' name='opcional' placeholder='Pregunta adicional: Formula la pregunta que introducirias para mejorar este cuestionario(valórala posteriormente).' value=''>\n\
                    <select class='col-lg-1 mb-2 text-center bg-light' name='respuestas[]'>\n\
                        <option></option>\n\
                        <option>1</option>\n\
                        <option>2</option>\n\
                        <option>3</option>\n\
                        <option>4</option>\n\
                        <option>5</option>\n\
                    </select>\n\
                    <div class='col-lg-1'></div></div>");
                    }
                    if (datos.preguntas[p].orden === 5 || datos.preguntas[p].orden === 6){
                  $("#encuesta").append("<div class='row pb-2 ml-1 mr-1'>\n\
                        <div class='col-lg-1'></div>\n\
                        <input readonly='' class='col-lg-2 text-center' name='p" + p + "' type='text' size='20' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
                        <textarea class='col-lg-8 bg-light' name='respuestas[]'></textarea>\n\
                        <div class='col-lg-1'></div>\n\
                    </div>");
                    }
                   
                    } else{
                    $("#encuesta").append("\
                    <div class='row ml-1 mr-1'>\n\
                    <div class='col-lg-1'></div>\n\
                    <input class='col-lg-9 p-1 mb-2' name='p" + p + "' type='text' size='40' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
                    <select class='col-lg-1 mb-2 text-center bg-light' name='respuestas[]'>\n\
                        <option></option>\n\
                        <option>1</option>\n\
                        <option>2</option>\n\
                        <option>3</option>\n\
                        <option>4</option>\n\
                        <option>5</option>\n\
                    </select>\n\
                    <div class='col-lg-1'></div></div>");
                    }
                    }
                    $("#enviar").append("<div class='col-lg-5'></div><input class='col-lg-2 text-center btn btn-dark' type='submit' name='enviar' value='Enviar'><div class='col-lg-5'></div>");
                    }
            });
            });
////////////////////////////////////////////////////////////////////////////////
            });

        </script>
    </head>
    <!--Autor: Beatriz-->
    <body class="container-fluid">
        @include('header')
        <div class="row text-center">
            <div  class="col-4"></div>
            <div class="col-4 pt-5">
                <div class="row">
                    <table class="table col-12 text-center border border-bottom border-left border-right border-top" style="background-color: #c4cccf">
                        <?php
                        echo ('<tr><th>Curso</th><td>' . $curso . '</td></tr>');
                        echo('<tr><th>Grupo</th><td>' . $grupo . '</td></tr>');
                        echo('<tr><th>Materia</th><td><select name="mat" id="materias"></select></td></tr>');
                        ?>
                    </table>
                </div>
            </div>    
            <div  class="col-4"></div>
        </div>
        <form class="row pt-5 pb-5" id='formulario' name='form' action='respuestas' method='POST'>
            {!! csrf_field(); !!}
        </form>
        <div class="row p-5"></div>
        @include('footer')
        <!--------------------------------------------------------------------->
    </body>
</html>