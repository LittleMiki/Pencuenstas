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
                            var txt = '<option></option>';
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
                            var f = new Date();
                            var datos = JSON.parse(respuesta);
                            $("#formulario div").remove();

                            $("#formulario").append("<div><input type='text' readonly name='nombre' value='" + datos.nombre[0].nombre + "'/>\n\
                                                    <label id='fecha'>" + f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear() + "</label>\n\
                                                    </div>");
                            for (var p in datos.preguntas) {
                                $("#formulario div").append("<input name='p" + p + "' type='text' size='40' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
                                                <select name='respuestas[]'>\n\
                                                <option>1</option>\n\
                                                <option>2</option>\n\
                                                <option>3</option>\n\
                                                <option>4</option>\n\
                                                <option>5</option>\n\
                                                </select>");

                            }
                            $("#formulario div").append("<input type='submit' name='enviar' value='Enviar'>");

//                                $(".preguntas").append("<div><form name='form' action='encuesta' method='POST'>\n\
//                                                <input id='p" + p + "' type='text' size='40' readonly value='" + datos.preguntas[p].pregunta + "'>\n\
//                                                <label for='r1'>1</label>\n\
//                                                <input type='radio' name='num' value='1'>\n\
//                                                <label for='r2'>2</label>\n\
//                                                <input type='radio' name='num' value='2'>\n\
//                                                <label for='r3'>3</label>\n\
//                                                <input type='radio' name='num' value='3'>\n\
//                                                <label for='r4'>4</label>\n\
//                                                <input type='radio' name='num' value='4'>\n\
//                                                <label for='r5'>5</label>\n\
//                                                <input type='radio' name='num' value='5'>\n\
//                                                <br></form></div>");
//
//                            }
                        }
                    }
                    );
                });
                ////////////////////////////////////////////////////////////////

            });

        </script>
    </head>
    <body>
        <div id="cabecera">

        </div>
        <div id="main">
            <h2>Bienvenido </h2>
            <table style="border: double 2px black;margin-bottom: 10px;text-align: center;padding: 3px; border-collapse: collapse" >
                <?php
                echo ('<tr><th>Curso</th> <th>Grupo</th> <th>Materia</th></tr>');
                echo ('<tr><td>' . $curso . '</td> <td>' . $grupo . '</td>');
                ?>
                <td>
                    <select name="mat" id="materias">
                    </select>
                </td>
            </table>
        </div>


        <form id='formulario' name='form' action='respuestas' method='POST'>
            {!! csrf_field(); !!}
        </form>

        <div id="footer">
        </div>
    </body>
</html>
