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
    <body class="content-fluid">
        @include('header')
        
        <div class="row pt-5 pb-5">
            
            <div class="col-4"></div>
            
            <div class="col-4 cajaSombra p-5" id="almacen">
               <form name="form" class="row" action="Tutor" method="POST">
                <div class="row pb-2">
                    <div class="col-2"></div>
                    <select class="col-8" name="selec" id="seleccion"><option disabled="disabled" selected="true">Seleccione una Opcion</option></select>
                    <div class="col-2"></div>
                </div>
                   
                    <script type = "text/javascript">
                        $(function () {
                         
                        $().ready(function () {
                        
                        $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                                url: 'AjaxCursos',
                                type: 'POST',
                                success: function (response) {
                                

                                var conjunto;
                                var datos = JSON.parse(response);
                                for (x in datos) {
                                conjunto = conjunto + '<option>' + datos[x].descripcion + ' </option>';
                                }
                                $("#seleccion").append(conjunto);
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
                        
                        $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                                url: 'AjaxProfes',
                                type: 'POST',
                                success: function (response) {
                                
                                var conjunto;
                                var datos = JSON.parse(response);
                                for (x in datos) {
                                conjunto = conjunto + '<option>' + datos[x].nombre + ' </option>';
                                }
                                $("#nuevoT").append(conjunto);
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
                        
                        $("#seleccion").change(function(){

                        var parametros = {"nombre":$("#seleccion").val()};
                        $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                                url: 'PeticionTutor',
                                type: 'POST',
                                data: parametros,
                                success: function (response) {
                               
                                var resultado = JSON.parse(response);
                                $("#tActual").val(resultado[0].tutor);
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
                        });
                    </script> 
                    
                        {!! csrf_field(); !!}
                        <div class="col-12">
                            <div class="row pb-4 ml-3">
                                <div class="col-3"></div>
                                <label>Tutor Actual</label>    <input type="text" name="tutorActual" id="tActual" value="">
                                <div class="col-3"></div>
                            </div>
                            <div class="row pb-4 ml-3">
                                <div class="col-3"></div>
                                <label>Tutor Nuevo</label>    <select name="nuevoTutor" id="nuevoT"><option disabled="disabled" selected="true">Seleccione una Opcion</option></select>
                                <div class="col-3"></div>
                            </div>
                            <div class="row pb-4 ml-3">
                                <div class="col-3"></div>
                                <input type="submit" name="aceptar" class= "col-6 btn btn-dark" value=" Guardar ">
                                <div class="col-3"></div>
                            </div>
                            <div class="row ml-3">
                                <div class="col-4"></div>
                                <input type="submit" name="aceptar" class= "col-4 btn btn-danger" value=" Cancelar ">
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row"><div class="col-12 pb-5"></div></div>
        @include('footer')
    </body>
</html>
