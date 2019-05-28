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
                    <div class="col-3"></div>
                    <div class="col-6 mt-3 " id="almacen">
                        <select name="selec" id="seleccion"><option disabled="disabled" selected="true">Seleccione una Opcion</option></select>
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
                                                url: 'AjaxModulos',
                                                type: 'POST',
                                                 
                                                
                                                success: function (response) {
                                                 // alert(response);
                                                    
                                                    var conjunto;
                                                    var datos = JSON.parse(response);
                                                    for (x in datos) {
                                                        conjunto  = conjunto+'<option>'+ datos[x].descripcion +' </option>';
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
                                        }).keyup();

                                    });
                                    
                                    $("#seleccion").change(function(){
                                        
                                        var parametros = {"modulo":$("#seleccion").val()};
                                        
                                        $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: 'PeticionModulos',
                                                type: 'POST',
                                                data: parametros,
                                                
                                                success: function (response) {
                                                  alert(response);
                                                 var resultado = JSON.parse(response);
                                                   $("#Id").val(resultado[0].id);
                                                   $("#Desc").val(resultado[0].descripcion);
                                                   $("#Cur").append('<option selected="true">'+resultado[0].curso+'</option>');
                                                  
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
                        
                             <form name="form" class="row" action="ModificarModulo" method="POST">
                                 {!! csrf_field(); !!}
                                 <label>Id del Modulo</label><input type="text" name="id"  class= " col-12" id="Id" value=""></br>
                                 <label>Descripcion del Modulo</label><input type="text" id="Desc"  class= " col-12" name="descripcion" value=""></br>
                                 <label>Curso al que pertenece</label><select name="curso"  class= " col-12" id="Cur"></select></br>
                                 <input type="submit" name="aceptar" class= " col-5 m-1" value=" Guardar ">
                                 <input type="submit" name="aceptar" class= " col-5 m-1" value=" Cancelar ">
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
                                                url: 'AjaxCursos',
                                                type: 'POST',
                                                 
                                                
                                                success: function (response) {
                                                 // alert(response);
                                                    
                                                    var conjunto;
                                                    var datos = JSON.parse(response);
                                                    for (x in datos) {
                                                        conjunto  = conjunto+'<option>'+ datos[x].descripcion +' </option>';
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
                                        }).keyup();

                                    });
                                    
                                    $("#seleccion").change(function(){
                                        
                                        var parametros = {"nombre":$("#seleccion").val()};
                                        //var par = {"nombre":$("#Tut").val()};
                                        
                                        $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: 'PeticionCursos',
                                                type: 'POST',
                                                data: parametros,
                                                
                                                success: function (response) {
                                                  alert(response);
                                                 var resultado = JSON.parse(response);
                                                   $("#Id").val(resultado[0].id);
                                                   $("#Desc").val(resultado[0].descripcion); 
                                                   $("#Ano").val(resultado[0].curso); 
                                                   $("#Gru").val(resultado[0].grupo); 
                                                   $("#Tut").html('<option selected="true" value="'+resultado[0].tutor+'">'+resultado[0].tutor+'</option>'); 
                                                   
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
//                                            var par = {nombre:$("#Tut option:selected").val()};
//                                            
//                                            $.ajax({
//                                                
//                                                headers: {
//                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                                                },
//                                                url: 'OtrosProfes',
//                                                type: 'POST',
//                                                data: par,
//                                                
//                                                success: function (response) {
//                                                 alert(response);
//                                                 alert($("#Tut option:selected").val());
//                                                 var txt;
//                                                 var result = JSON.parse(response);
//                                                   for (x in datos) {
//                                                         txt = txt + '<option>' + datos[x].descripcion + '</option>';
//                                                   }
//                                                   $("#Tut").html(txt); 
//                                                  
//                                                },
//                                                statusCode: {
//                                                    404: function () {
//                                                        alert('web not found');
//                                                    }
//                                                },
//                                                error: function (x, xs, xt) {
//
//                                                    window.open(JSON.stringify(x));
//                                                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
//                                                }
//                                            });
                                    
                                   });
                             </script>    
                             
                             
                             
                             
                             
                          <form name="form" class="row" action="ModificarCurso" method="POST">
                                 {!! csrf_field(); !!}
                                 <label>Id del Curso</label><input type="text" class= " col-12" name="id" id="Id" value=""></br>
                                 <label>Descripcion del Modulo</label><input type="text"   class= "col-12" id="Desc" name="descripcion" value=""></br>
                                 <label>Año</label><input type="text" name="curs" id="Ano"  class= " col-12" value=""></br>
                                 <label>Grupo</label><input type="text" name="grupo" id="Gru"  class= " col-12" value=""></br>
                                 <label>Tutor</label> <select  class= "col-12" name="tutor" id="Tut"> </select>
                                 <input type="submit" name="aceptar"  class= " col-5 m-1" value="  Guardar ">
                                 <input type="submit" name="aceptar"   class= " col-5 m-1" value=" Cancelar ">
                          </form>
                        <?php
                        }
                        if($accion == 'Profesor'){
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
                                                 
                                                
                                                success: function (response) {
                                                 // alert(response);
                                                    
                                                    var conjunto;
                                                    var datos = JSON.parse(response);
                                                    for (x in datos) {
                                                        conjunto  = conjunto+'<option>'+ datos[x].nombre +' </option>';
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
                                        }).keyup();

                                    });
                                    
                                    $("#seleccion").change(function(){
                                        
                                        var parametros = {"nombre":$("#seleccion").val()};
                                        
                                        $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: 'PeticionProfes',
                                                type: 'POST',
                                                data: parametros,
                                                
                                                success: function (response) {
                                                  alert(response);
                                                 var resultado = JSON.parse(response);
                                                   $("#usu").val(resultado[0].usuario);
                                                   $("#pas").val(resultado[0].pass); 
                                                   $("#nomb").val(resultado[0].nombre); 
                                                   if(resultado[0].rol === 2){
                                                        $("#Car").html('<option selected="true">Profesor</option> <option>Director</option>');
                                                   }else{
                                                       $("#Car").html('<option >Profesor</option> <option selected="true">Director</option>');
                                                   }
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
                             <form name="form" class="row" action="ModificarProfesor" method="POST">
                                 {!! csrf_field(); !!}
                                 <label>Usuario :</label><input type="text" name="usuario"  class= " col-12" id="usu" value=""></br>
                                 <label>Pass :</label><input type="password" name="pass" id="pas"  class= " col-12" value=""></br>
                                 <label>Nombre :</label><input type="text" name="nombre"  id="nomb"  class= " col-12" value=""></br>
                                 <label>Cargo :</label><select name="cargo" class="col-12" id="Car"></select></br>
                                 <input type="submit" name="aceptar" class= " col-5 m-1" value=" Guardar ">
                                 <input type="submit" name="aceptar" class= " col-5 m-1" value=" Cancelar ">
                             </form>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            @include('footer')
        </div>
    </body>
</html>
