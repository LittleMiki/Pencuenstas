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
            <div class="col-4 cajaSombra p-5" id="almacen">
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
                                url: 'AjaxModulos',
                                type: 'POST',
                                success: function (response) {
                                // alert(response);
                                var principio = '<form name="form" class="row pb-2" action="BorrarModulo" method="POST"> {!! csrf_field(); !!}';
                                var fin = '</form>';
                                var conjunto;
                                var datos = JSON.parse(response);
                                for (x in datos) {
                                conjunto = principio + '<input type="text class="pr-5" hidden="" name="nombre" value="' + datos[x].descripcion + '"> <label class="col-9">' + datos[x].descripcion + '</label><input type=submit class="btn btn-danger col-3" name="borar" value="borrar">' + fin;
                                $("#almacen").append(conjunto);
                                }

                                //$("#almacen").append(conjunto);

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
                                url: 'AjaxCursos',
                                type: 'POST',
                                //data: {"compuesto" :$(this).val() },
                                success: function (response) {
                                //alert(response);
                                var principio = '<form name="form" class="row pb-2" action="BorrarCurso" method="POST"> {!! csrf_field(); !!}';
                                var fin = '</form>';
                                var conjunto;
                                var datos = JSON.parse(response);
                                for (x in datos) {
                                conjunto = principio + '<input type="text class="pr-5" hidden="" name="nombre" value="' + datos[x].descripcion + '"> <label class="col-9">' + datos[x].descripcion + '</label> <input type=submit class="btn btn-danger col-3" name="borar" value="borrar">' + fin;
                                $("#almacen").append(conjunto);
                                }

                                //$("#almacen").append(conjunto);

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

                    <?php
                }
                if ($accion == 'Profesor') {
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
                                // alert(response);
                                var principio = '<form name="form" class="row pb-2" action="BorrarProfesor" method="POST"> {!! csrf_field(); !!}';
                                var fin = '</form>';
                                var conjunto;
                                var datos = JSON.parse(response);
                                for (x in datos) {
                                conjunto = principio + '<input type="text" class="text-center m-1" hidden="" name="nombre" value="' + datos[x].nombre + '"> <label class="col-9">' + datos[x].nombre + '</label> <input type=submit class="btn btn-danger col-3" name="borar" value="borrar">' + fin;
                                $("#almacen").append(conjunto);
                                }

                                //$("#almacen").append(conjunto);

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
