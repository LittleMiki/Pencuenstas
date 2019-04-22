<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity=""
        crossorigin="anonymous"></script>
        <script type = "text/javascript">
             $(function () {
                 $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'miJqueryAjax',
                        type: 'POST',
                        //data: {"compuesto" :$(this).val() },
                        success: function (response) {
                            // alert(response);
                            var txt = '';
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
            
            
        </script>
    </head>
    <body>
        <?php
        if ($tipo == 'alumno') {
            ?>
            <div id="cabecera">

            </div>
            <div id="main">
                <table style="border: double 2px black;margin-bottom: 10px" >
                    <?php
                    echo ('<tr><th>Alumno</th> <td>' . $alumno . '</td></tr>');
                    echo ('<tr><th>Curso</th> <td>' . $curso . '</td></tr>');
                    echo ('<tr><th>Grupo</th> <td>' . $grupo . '</td></tr>');
                    ?>
                </table>
                <form name="form" action="Hencuesta" method="POST">
                    {!! csrf_field(); !!}
                    <input type="submit" name="boton" value="Realizar Encuesta">
                </form>
                <form name="form" action="volver" method="POST">
                    {!! csrf_field(); !!}
                    <input type="submit" name="boton" value="volver">
                </form>
            </div>
            <div id="footer">

            </div>
            <?php
        } else {
            ?>
            <div id="cabecera">

            </div>
            <div id="main">
                <form name="form" action="ACprofesor" method="POST">
                    {!! csrf_field(); !!}
                <table style="border: double 2px black;margin-bottom: 10px" >
                  
                    <tr><th>Profesor</th> <td>  <?php echo $nombre ?></td></tr>
                    <tr><th>Curso</th> <td><select name="curso"><option>1</option><option>2</option>
                    </select></td></tr>
                    <tr><th>Materia</th> <td><select name="mat" id="materias">
                    </select></td></tr>
                   
                    
                </table>
               
                    
                    <input type="submit" name="boton" value="Resumen profesor"></br>
                    <input type="submit" name="boton" value="Ver encuestas"></br>
                    <?php
                        if($tutor){
                            echo '<input type="submit" name="boton" value="Resumen Tutor"></br>';
                        }
                    ?> 
                    <input type="submit" name="boton" value="Generar Usuarios"></br>
                    <input type="submit" name="boton" value="volver"></br>
                </form>
            </div>
            <div id="footer">

            </div>

            <?php
        }
        ?>
    </body>
</html>
