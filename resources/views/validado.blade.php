<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity=""
        crossorigin="anonymous"></script>
        <script type = "text/javascript">

            //Miguel//
            $(function () {

                $().ready(function () {


                    //          alert(com);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'miJqueryAjax',
                        type: 'POST',

                        //data: {"compuesto" :$(this).val() },
                        success: function (response) {
                            // alert(response);
                            var txt;
                            var datos = JSON.parse(response);
                            for (x in datos) {
                                txt = txt + '<option>' + datos[x].Descripcion + '</option>';
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
                ////////////////////////////////////////////////////////////////
                //
                //Bea//
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

                            var datos = JSON.parse(respuesta);
                            $(".nombres").remove();
                             $(".preguntas div").remove();
                            $("#nombre").append("<input type='text' size='30' readonly class='nombres' value='" + datos.nombre[0].nombre + "'>");
//                            
                            for (var p in datos.preguntas) {
                                $(".preguntas").append("<div><input id='p" + p + "'type='text' size='40' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
                                                <label for='r1'>1</label>\n\
                                                <input type='radio' id='r1' name='num' value='1'>\n\
                                                <label for='r2'>2</label>\n\
                                                <input type='radio' id='r2' name='num' value='2'>\n\
                                                <label for='r3'>3</label>\n\
                                                <input type='radio' id='r3' name='num' value='3'>\n\
                                                <label for='r4'>4</label>\n\
                                                <input type='radio' id='r4' name='num' value='4'>\n\
                                                <label for='r5'>5</label>\n\
                                                <input type='radio' id='r5' name='num' value='5'>\n\
                                                <br></div>");
                                                    
                            }
                        }
                    });
                });
                ////////////////////////////////////////////////////////////////

            });

        </script>
    </head>
    <body>
        <div id="cabecera">

        </div>
        <div id="main">
            <h2>Bienvenido Usuario</h2>
            <label>Seleccione la materia</label> <select name="mat" id="materias">
            </select>
        </div>
        <div id="nombre"></div>
        <div class="preguntas"><div></div></div>
        <div id="footer">

        </div>
    </body>
</html>
