<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/EstilosPropios.css" rel="stylesheet" />
        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity=""
        crossorigin="anonymous"></script>
        <script type = "text/javascript">
$(function () {
    var parametros = {"tipo": '<?php echo $tipo; ?>',
        "nombre": '<?php echo $nombre; ?>'};
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'miJqueryAjax',
        type: 'POST',
        data: parametros,
        success: function (response) {

            var txt = '';
            var datos = JSON.parse(response);
            alert(response);
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


        </script>

    </head>
    <body class='content-fluid'>

        <?php
        if ($tipo == 'alumno') {
            ?>
            <div id="cabecera" class="col-12">

            </div>
            <div id="main" class='row text-center'>
                <div  class="col-4">

                </div>
                <div class="col-4">
                    <div class="row">
                        <table class="table col-12 " style="background-color: #c4cccf" >
                            <?php
                            echo ('<tr><th>Alumno</th> <td>' . $nombre . '</td></tr>');
                            echo ('<tr><th>Curso</th> <td>' . $curso . '</td></tr>');
                            echo ('<tr><th>Grupo</th> <td>' . $grupo . '</td></tr>');
                            ?>
                        </table>
                    </div>    
                    <form name="form" action="Hencuesta" method="POST">

                        {!! csrf_field(); !!} 
                        <div class="form-group row">
                            <input type="submit" class="btn btn-success col-12" name="boton" value="Realizar Encuesta">
                        </div>
                    </form>
                    <form name="form" action="volver" method="POST">
                        {!! csrf_field(); !!}
                        <div class="form-group row">
                            <input type="submit" class="btn btn-success col-12" name="boton" value="volver">
                        </div>
                    </form>
                </div>
                <div  class="col-4">

                </div>
            </div>
            <div id="footer" class="col-12">

            </div>
            <?php
        }
        if ($tipo == 'profesor') {
            ?>
            <div id="cabecera" class="col-12">

            </div>
            <div id="main" class='row  '>
                <div class="col-4">

                </div>
                <div class="col-4 center m-2 " >

                    <form name="form" action="ACprofesor"  method="POST">
                        {!! csrf_field(); !!}
                        <div class=" row">
                            <div class="col-12">
                                <table class="table p-2" style="background-color: #c4cccf" >

                                    <tr>
                                        <th>Profesor</th>
                                        <td>  <?php echo $nombre ?></td>
                                    </tr>
                                    <tr>
                                        <th>Curso</th> 
                                        <td>
                                            <select name="curso"><option>1</option><option>2</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Materia</th>
                                        <td>
                                            <select name="mat" id="materias">
                                            </select>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class='row mt-1'>
                            <input type="submit" name="boton" class='btn btn-success  col-12' value="Resumen profesor"></br>
                        </div>
                        <div class='row mt-1'>
                            <input type="submit" name="boton" class='btn btn-success col-12' value="Ver encuestas"></br>
                        </div>
                        <?php
                        if ($tutor) {
                            echo '<div class="row mt-1"> <input type="submit" name="boton" class="btn btn-success col-12" value="Resumen Tutor"></br> </div>';
                        }
                        ?> 
                        <div class='row mt-1 '>
                            <input type="submit" name="boton" class='btn btn-success col-12' value="Generar Usuarios"></br>
                        </div>
                        <div class='row mt-1'>
                            <input type="submit" name="boton" class='btn btn-success col-12' value="volver"></br>
                        </div>

                    </form>
                </div>
                <div class="col-4">

                </div>
            </div>

            <div id="footer" class="col-12">

            </div>

            <?php
        }
        if ($tipo == 'Director') {
            ?>
            <div id="cabecera" class="col-12">

            </div>
            <div id="main" class='row  '>
                <div class="col-4">

                </div>
                <div class="col-4 center m-2 " >

                    <form name="form" action="ACprofesor"  method="POST">
                        {!! csrf_field(); !!}
                        <div class=" row">
                            <div class="col-12">
                                <table class="table p-2" style="background-color: #c4cccf" >

                                    <tr>
                                        <th>Director/ra</th>
                                        <td>  <?php echo $nombre ?></td>
                                    </tr>
                                    <tr>
                                        <th>Curso</th> 
                                        <td>
                                            <select name="curso"><option>1</option><option>2</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Materia</th>
                                        <td>
                                            <select name="mat" id="materias">
                                            </select>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class='row mt-1'>
                            <input type="submit" name="boton" class='btn btn-success  col-12' value="Nuevo Profesor"></br>
                        </div>
                        <div class='row mt-1'>
                            <input type="submit" name="boton" class='btn btn-success col-12' value="Dar de baja profesor"></br>
                        </div>
                        <div class='row mt-1 '>
                            <input type="submit" name="boton" class='btn btn-success col-12' value="Generar Usuarios"></br>
                        </div>
                        <div class='row mt-1'>
                            <input type="submit" name="boton" class='btn btn-success col-12' value="volver"></br>
                        </div>

                    </form>
                </div>
                <div class="col-4">

                </div>
            </div>

            <div id="footer" class="col-12">

            </div>
            <?php
        }
        ?>
    </body>
</html>
