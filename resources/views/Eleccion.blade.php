<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
    <body class="container-fluid">
        <?php
        if ($tipo == 'alumno') {
            ?>
            @include('header')
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 pb-5">
                    <div id="main" class="row text-center">
                        <div  class="col-3"></div>
                        <div class="col-6 pt-5">
                            <div class="row">
                                <table class="table col-12 border border-bottom border-left border-right border-top" style="background-color: #c4cccf;">
                                    <?php
                                    echo ('<tr><th>Alumno</th> <td>' . $nombre . '</td></tr>');
                                    echo ('<tr><th>Curso</th> <td>' . $curso . '</td></tr>');
                                    echo ('<tr><th>Grupo</th> <td>' . $grupo . '</td></tr>');
                                    ?>
                                </table>
                            </div> 
                            <div class="cajaSombra p-5">
                                <form name="form" action="Hencuesta" method="POST">
                                    {!! csrf_field(); !!} 
                                    <div class="row pb-3 text-center">
                                        <div class="col-2"></div>
                                        <input type="submit" class="btn btn-dark col-8" name="boton" value="Realizar Encuesta">
                                        <div class="col-2"></div>
                                    </div>
                                </form>
                                <form name="form" action="cerrar">
                                    {!! csrf_field(); !!}
                                    <div class="row text-center">
                                        <div class="col-3"></div>
                                        <input type="submit" class="btn btn-danger col-6" name="boton" value="Cerrar Sesión">
                                        <div class="col-3"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div  class="col-3"></div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            @include('footer')
            <?php
        }
        if ($tipo == 'profesor') {
            ?>
            @include('header')
            <form name="form" action="ACprofesor"  method="POST">
                {!! csrf_field(); !!}
                <div class="row pt-5">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <table class="table border border-bottom border-left border-right border-top" style="background-color: #c4cccf" >
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
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 cajaSombra p-5">
                        <div class='row pb-4 pl-5'>
                            <input type="submit" name="boton" class='btn btn-dark text-center col-5 pl-1' value="Resumen profesor">
                            <input type="submit" name="boton" class='btn btn-dark text-center col-5 ml-1' value="Ver encuestas">
                        </div>
                        <?php
                        if ($tutor) {
                            echo '<div class="row pb-4"><div class="col-2"></div>'
                            . '<input type="submit" name="boton" class="btn btn-dark col-8 text-center" value="Resumen Tutor">'
                            . '<div class="col-2"></div></div>';
                        }
                        ?> 
                        <div class='row'>
                            <div class='col-4'></div>
                            <input type="submit" name="boton" class='btn btn-danger col-4 text-center' value="Cerrar Sesion">
                            <div class='col-4'></div>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row p-5"></div>
            </form>
            @include('footer')

            <?php
        }
        if ($tipo == 'Director') {
            ?>
            @include('header')
            <form name="form" action="GUsuarios"  method="POST">
                {!! csrf_field(); !!}
                <div class="row pt-5">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <table class="table border border-bottom border-left border-right border-top" style="background-color: #c4cccf" >
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
                                    <tr>
                                        <th></th>
                                        <td>
                                            <input type="submit" name="boton" class='btn btn-dark text-center' value="Generar Usuarios">     
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
            </form>
            <form name="form" action="ACDirector"  method="POST">  
                {!! csrf_field(); !!}
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 cajaSombra pt-5 pb-5 pl-3 pl-3">
                        <div class="row ml-4 pb-3">
                            <div class='row m-3'><div class='col-12'></div></div>
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 text-center' value="Nuevo Profesor">
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 text-center' value="Nuevo Modulo">
                            <input type="submit" name="boton" class='btn btn-dark  col-3 text-center' value="Nuevo Curso">
                        </div>
                        <div class='row ml-4 pb-3'>
                            <div class='row m-3'><div class='col-12'></div></div>
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 text-center' value="Borrar Profesor">
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 text-center' value="Borrar Modulo">
                            <input type="submit" name="boton" class='btn btn-dark  col-3 text-center' value="Borrar Curso">
                        </div>
                        <div class='row ml-4 pb-3'>
                            <div class='row m-3'><div class='col-12'></div></div>
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 pl-1' value="Modificar Profesor">
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 pl-1' value="Modificar Modulo">
                            <input type="submit" name="boton" class='btn btn-dark  col-3' value="Modificar Curso">
                        </div>
                        <div class='row ml-5 pb-3'>
                            <div class='row m-3 pl-5'><div class='col-12'></div></div>
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 pl-1' value="Asignar Tutor">
                            <input type="submit" name="boton" class='btn btn-dark  col-3 mr-1 pl-1' value="Asignar Profesores">
                        </div>
                        <div class='row pb-2'>
                            <div class='col-4'></div>
                            <input type="submit" name="boton" class='btn btn-danger mt-1 col-4 text-center' value="Cerrar Sesion">
                            <div class='col-4'></div>
                        </div>
                        <div class='row'>
                            <div class='col-5'></div>
                            <input type="submit" name="boton" class='btn btn-danger col-2 text-center' value="volver">
                            <div class='col-5'></div>
                        </div>

                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row p-5"></div>
            </form>
            @include('footer')
            <?php
        }
        ?>
    </body>
</html>
