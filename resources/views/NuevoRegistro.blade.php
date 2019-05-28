<!--Autor: Miguel Angel-->
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
       

    </head>
    <body class="content-fluid">
        <div class="row">
           
                 @include('header')
            
            <div id="main" class="col-12 text-center">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 mt-3 ">
                         <?php
                            if($accion == 'Modulo'){
                         ?>
                         <script type = "text/javascript">
                                $(function () {

                                        $().ready(function () {
                                              //          alert(com);
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: 'AjaxCursos',
                                                type: 'POST',
                                                 
                                                //data: {"compuesto" :$(this).val() },
                                                success: function (response) {
                        //                            alert(response);
                                                    var txt = '<option></option>';
                                                    var datos = JSON.parse(response);
                                                    for (x in datos) {
                                                        txt = txt + '<option>' + datos[x].descripcion + '</option>';
                                                    }
                                                    $("#cursos").html(txt);

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

                                    });
                             </script>
                        <form name="form" class="row" action="RegistroModulo" method="POST">
                             {!! csrf_field(); !!}
                             <div class="col-12">
                                <label class="m-1" >Id del Modulo </label> <input type="text" name="id"></br>
                                <label class="m-1">Descripcion del Modulo </label><input type="text" name="descripcion"></br>
                                <label class="m-1">Curso al que pertenece</label><select name="curso" id="cursos"></select>
                             </div>
                              <div class="col-12">
                                 <input type="submit" class="btn btn-success m-2" name="Aceptar" value="Aceptar"></br>
                                 <input type="submit" class="btn btn-danger" name="Cancelar" value="Cancelar">
                             </div>
                        </form>
                        <?php
                        }
                        
                        if($accion == 'Curso'){
                         ?>
                             <script type = "text/javascript">
                                $(function () {

                                        $().ready(function () {
                                              //          alert(com);
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: 'AjaxProfes',
                                                type: 'POST',
                                                 
                                                //data: {"compuesto" :$(this).val() },
                                                success: function (response) {
                        //                            alert(response);
                                                    var txt = '<option></option>';
                                                    var datos = JSON.parse(response);
                                                    for (x in datos) {
                                                        txt = txt + '<option>' + datos[x].nombre + '</option>';
                                                    }
                                                    $("#profes").html(txt);

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

                                    });
                             </script>
                          <form name="form" class=" row" action="RegistroCurso" method="POST">
                             {!! csrf_field(); !!}
                             <div class="col-6  ml-5 ">
                                 <label>Id del Curso </label> <input type="text" name="id">
                                 <label>Descripcion del Curso </label> <input type="text" name="descripcion">
                                 <label>Año del Curso </label><input type="number" name="curso">
                                 <label>Grupo del Curso </label><input type="text" name="grupo">
                                 <label>Tutor del Curso </label><select name="profesores" id="profes"></select>
                             </div>
                             <div class="col-6 ml-5">
                                <input type="submit" class="btn btn-success m-2" name="Aceptar" value="Aceptar">
                                <input type="submit" class="btn btn-danger" name="Cancelar" value="Cancelar">
                             </div>
                        </form>
                        <?php
                        }
                        if($accion == 'Profesor'){
                        ?>
                        <form name="form" class="row" action="RegistroProfesor" method="POST">
                             {!! csrf_field(); !!}
                             <div class="col-12">  
                                <label>Usuario </label> <input type="text" name="usuario"></br>
                                <label>Pass </label> <input type="password" name="pass"></br>
                                <label>Nombre del Usuario </label> <input type="text" name="nombre"></br>
                            </div>
                             <div class="col-12">
                                 <input type="submit" name="Aceptar" class="btn btn-success m-2" value="Aceptar"></br>
                                 <input type="submit" name="Cancelar" class="btn btn-danger" value="Cancelar">
                             </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
            @include('footer')
        </div>
    </body>
</html>
