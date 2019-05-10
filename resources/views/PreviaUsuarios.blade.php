<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       

    </head>
    <body>
        @include('header')
        <div id="main">
            <h2>Login</h2>
            <form name="form" action="validar" method="POST">
                {!! csrf_field(); !!}
                <label> Usuario </label> <input type="text" name="usuario" value="" placeholder="Usuario"></br>
                <label> Contrasenia </label> <input type="password" name="pass" value="" placeholder="Pass"></br>
                <input type="submit" name="aceptar" value="aceptar">
            </form>
        </div>
        @include('footer')
    </body>
</html>
