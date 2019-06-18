<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    </head>
    <body class="container-fluid">
        <div id="main" class="row mt-3">
            <div class="col-4"></div>
            <div class="col-4 p-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="Logos Virgen/02 LOGO CIFP VdG.jpg" width="100%"> 
                    </div>    
                </div>
                <form class="row p-4 cajaIndex" name="form" action="validar" method="POST">
                    {!! csrf_field(); !!}
                    <div class="col-2"></div>
                    <div class="form-group col-8 pt-4">
                        <div class="row">
                            <input type="text" class="col-12 form-control text-center" name="usuario" value="" placeholder="Usuario">
                        </div>
                        <div class="row pt-4">
                            <input type="password" class="col-12 form-control text-center" name="pass" value="" placeholder="Pass">
                        </div>
                        <div class="row pt-4">
                            <input type="submit" class="col-12 btn btn-dark" name="aceptar" value="aceptar">
                        </div>
                    </div>
                    <div class="col-2"></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
