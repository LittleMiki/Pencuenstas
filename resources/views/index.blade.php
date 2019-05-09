<!--Autor: Miguel Angel-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/EstilosPropios.css" rel="stylesheet" />


    </head>
    <body class="content-fluid">
        <div class="row">
            <div id="cabecera" class="col-12">

            </div>
            <div id="main" class="col-12 text-center">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 mt-3 ">
                        <div class="row">
                            <div class="col-12">
                                <img src="Logos Virgen/02 LOGO CIFP VdG.jpg" width="100%"> 
                            </div>    
                        </div>
                        <div class="row  p-2" style="border-radius: 5%;background-color: #8bacc1">
                            <form name="form" action="validar" method="POST">
                                {!! csrf_field(); !!}
                                <div class="form-group row pr-2">
                                    <div class="col-12 m-1 ">
                                         <input type="text" class="form-control text-center" name="usuario" value="" placeholder="Usuario"></br>
                                    </div>
                                    <div class="col-12 m-1 ">
                                        <input type="password" class="form-control text-center" name="pass" value="" placeholder="Pass"></br>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" class="btn btn-success col-12" name="aceptar" value="aceptar">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
            <div id="footer" class="col-12 ">

            </div>
        </div>
    </body>
</html>
