<!--Autor: Miguel Angel-->
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
        <div id="main" style="text-align: center">
            <table>
                <tr>

                    <th>Usuario</th>

                    <th>Pass</th>


                </tr>
                <?php
                echo $usus;
                ?>
            </table>
            <form name="form" action="volver" method="POST">
                {!! csrf_field(); !!}
                <input type="submit" name="boton" value="volver">
            </form>
        </div>
        <div id="footer">

        </div>
    </body>
</html>
