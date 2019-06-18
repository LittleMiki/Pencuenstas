<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script type = "text/javascript">


        </script>

    </head>
    <body class='container-fluid'>

        @include('header')
        <div id="main" class='row text-center'>
            <div  class="col-4"></div>

            <div class="col-4 pb-5 pt-5 pl-5 pr-3 mt-5 cajaSombra">
                <form name="form" action="Rol" method="POST">
                    {!! csrf_field(); !!} 
                    <div class="form-group row text-center">
                        <input type="submit" class="btn btn-dark col-5  ml-3 mr-1" name="boton" value="Profesor">
                        <input type="submit" class="btn btn-dark col-5" name="boton" value="Director">
                    </div>
                </form>
                <form class="row pr-4 pt-4 text-center" name="form" action="volver" method="POST">
                    {!! csrf_field(); !!}
                    <div class="col-4"></div>
                    <input type="submit" class="btn btn-danger col-4" name="boton" value="volver">
                    <div class="col-4"></div>
                </form>
            </div>

            <div  class="col-4"></div>
        </div>
        @include('footer')

    </body>
</html>
