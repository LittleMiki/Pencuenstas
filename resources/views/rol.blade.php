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


        </script>

    </head>
    <body class='content-fluid'>

            @include('header')
            <div id="main" class='row text-center'>
                <div  class="col-4">

                </div>
                <div class="col-4">
                  
                    <form name="form" action="Rol" method="POST">

                        {!! csrf_field(); !!} 
                        <div class="form-group row pt-4 ml-4 center">
                            <input type="submit" class="btn btn-success col-4 mr-1" name="boton" value="Profesor">
                            <input type="submit" class="btn btn-success col-4" name="boton" value="Director">
                        </div>
                    </form>
                    <form name="form" action="volver" method="POST">
                        {!! csrf_field(); !!}
                        <div class="form-group row ml-4">
                            <input type="submit" class="btn btn-success col-6" name="boton" value="volver">
                        </div>
                    </form>
                </div>
                <div  class="col-4">

                </div>
            </div>
            @include('footer')

    </body>
</html>
