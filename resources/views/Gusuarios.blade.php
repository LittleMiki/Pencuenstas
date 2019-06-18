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
        <div id="main" style="text-align: center">

                <?php
                echo $usus;
                ?>
            </table>
            
            <form name="form" action="Descargar" method="POST">
                {!! csrf_field(); !!}
                <input type="submit" name="boton" value="Descargar">
            </form>
            <form name="form" action="ACprofesor" method="POST">
                {!! csrf_field(); !!}
                <input type="submit" name="boton" value="volver">
            </form>
        </div>
        @include('footer')
    </body>
</html>
