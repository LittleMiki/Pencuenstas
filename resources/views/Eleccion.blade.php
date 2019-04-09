<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">



    </head>
    <body>
        <div id="cabecera">

        </div>
        <div id="main">
            <table style="border: double 2px black;margin-bottom: 10px" >
                <?php
                echo ('<tr><th>Alumno</th> <td>' . $alumno . '</td></tr>');
                echo ('<tr><th>Curso</th> <td>' . $curso . '</td></tr>');
                echo ('<tr><th>Grupo</th> <td>' . $grupo . '</td></tr>');
                ?>
            </table>
            <form name="form" action="Hencuesta" method="POST">
                {!! csrf_field(); !!}
                <input type="submit" name="boton" value="aceptar">
            </form>
            <form name="form" action="volver" method="POST">
                {!! csrf_field(); !!}
                <input type="submit" name="boton" value="volver">
            </form>
        </div>
        <div id="footer">

        </div>
    </body>
</html>
