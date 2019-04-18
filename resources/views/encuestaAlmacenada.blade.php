<!--Autor: Beatriz -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type = "text/javascript">
            $(function () {
                $("#dialog").dialog();
                $("button").click(function () {
                    $("#dialog").dialog('close');
                    $("#texto").append('Encuesta insertada,retrocede para realizar otra.');
                });
            });


        </script>
    </head>
    <body>
        <div id="dialog" title="Información">
            <p>La encuesta ha sido almacenada</p>
            <button>Aceptar</button>
        </div>
        <p id="texto"></p>
    </body>
</html>
