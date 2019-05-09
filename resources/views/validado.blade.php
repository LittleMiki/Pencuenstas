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
                        }
                    }
                    );
                });
////////////////////////////////////////////////////////////////////////////////

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
