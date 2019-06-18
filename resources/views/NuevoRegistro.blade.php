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
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body class="container-fluid">
        @include('header')  
        <div class="row pt-5 pb-5">
            <div class="col-4"></div>
            <div class="col-4 cajaSombra p-5">
                <?php
                if ($accion == 'Modulo') {
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
                            <div class="row pb-2 pl-3"> 
                                <h6 class="col-12 text-center">Nuevo Modulo</h6>
                            </div>
                            <div class="row pb-2 pl-3">  
                                <input class="col-12 text-center" type="text" name="id" placeholder="Id">
                            </div>
                            <div class="row pb-2 pl-3">
                                <input class="col-12 text-center" type="text" name="descripcion" placeholder="Descripción">
                            </div>
                            <div class="row pb-4 pl-3">
                                <label class="col-2">Curso</label><select class="col-10" name="curso" id="cursos"></select> 
                            </div>
                            <div class="row pb-4 ml-3">
                                <div class="col-3"></div>
                                <input type="submit" name="btn" class="col-6 btn btn-dark" value="Aceptar">
                                <div class="col-3"></div>
                            </div>
                            <div class="row ml-3">
                                <div class="col-4"></div>
                                <input type="submit" name="btn" class="col-4 btn btn-danger" value="Cancelar">
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </form>
                    <?php
                }

                if ($accion == 'Curso') {
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
                    <form name="form" class="row" action="RegistroCurso" method="POST">
                        {!! csrf_field(); !!}
                        <div class="col-12">
                            <div class="row pb-2 pl-3"> 
                                <h6 class="col-12 text-center">Nuevo Curso</h6>
                            </div>
                            <div class="row pb-2 pl-3">  
                                <input class="col-12 text-center" type="text" name="id" placeholder="Id">
                            </div>
                            <div class="row pb-2 pl-3">
                                <input class="col-12 text-center" type="text" name="descripcion" placeholder="Descripción">
                            </div>
                            <div class="row pb-2 pl-3">  
                                <input class="col-12 text-center" type="number" name="curso" placeholder="Año">
                            </div>
                            <div class="row pb-2 pl-3">  
                                <input class="col-12 text-center" type="text" name="grupo" placeholder="Grupo">
                            </div>
                            <div class="row pb-4 pl-3">
                                <label class="col-2">Tutor</label><select class="col-10" name="profesores" id="profes"></select> 
                            </div>
                            <div class="row pb-4 ml-3">
                                <div class="col-3"></div>
                                <input type="submit" name="btn" class="col-6 btn btn-dark" value="Aceptar">
                                <div class="col-3"></div>
                            </div>
                            <div class="row ml-3">
                                <div class="col-4"></div>
                                <input type="submit" name="btn" class="col-4 btn btn-danger" value="Cancelar">
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                if ($accion == 'Profesor') {
                    ?>
                    <form name="form" class="row" action="RegistroProfesor" method="POST">
                        {!! csrf_field(); !!}
                        <div class="col-12">
                            <div class="row pb-2 pl-3"> 
                                <h6 class="col-12 text-center">Nuevo Profesor</h6>
                            </div>
                            <div class="row pb-2 pl-3">  
                                <input class="col-12 text-center" type="text" name="usuario" placeholder="Usuario">
                            </div>
                            <div class="row pb-2 pl-3">
                                <input class="col-12 text-center" type="password" name="pass" placeholder="Pass">
                            </div>
                            <div class="row pb-4 pl-3">
                                <input class="col-12 text-center" type="text" name="nombre" placeholder="Nombre">
                            </div>
                            <div class="row pb-4 ml-3">
                                <div class="col-3"></div>
                                <input type="submit" name="btn" class="col-6 btn btn-dark" value="Aceptar">
                                <div class="col-3"></div>
                            </div>
                            <div class="row ml-3">
                                <div class="col-4"></div>
                                <input type="submit" name="btn" class="col-4 btn btn-danger" value="Cancelar">
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row"><div class="col-12 pb-5"></div></div>
        @include('footer')
    </body>
</html>
