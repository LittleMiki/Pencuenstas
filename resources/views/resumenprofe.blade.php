<!--Autor: Beatriz-->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script> 
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    </head>
    <body class="container">
        <table class="table text-center" style="background-color: #c4cccf">
                    <?php
                    echo ('<tr><th>Grupo</th><td>' . $grupo[0]->curso ." " .$grupo[0]->grupo." ".$grupo[0]->descripcion.'</td></tr>');
                    echo('<tr><th>Asignatura</th><td>' . $materia . '</td></tr>');
                    ?>
                    <tr><th>Fecha</th><td><?php echo date("d") . "/" . date("m") . "/" . date("Y");?></td></tr>
                    
                </table>
    </body>
</html>