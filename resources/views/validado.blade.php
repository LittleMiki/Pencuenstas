<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity=""
        crossorigin="anonymous"></script>
        <script type = "text/javascript">

            $(function () {

                $().ready(function () {


        //          alert(com);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'miJqueryAjax',
                        type: 'POST',
                      
                        //data: {"compuesto" :$(this).val() },
                        success: function (response) {
                           // alert(response);
                            var txt;
                            var datos = JSON.parse(response);
                            for (x in datos) {
                                txt = txt + '<option>' + datos[x].Descripcion + '</option>';
                            }
                            $("#materias").html(txt);

                        },
                        statusCode: {
                            404: function () {
                                alert('web not found');
                            }
                        },
                        error: function (x, xs, xt) {
                            
                            window.open(JSON.stringify(x));
                            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                        }
                    });
                }).keyup();

            });

        </script>
    </head>
    <body>
        <div id="cabecera">

        </div>
        <div id="main">
            <h2>Bienvenido Usuario</h2>
            <label>Seleccione la materia</label> <select name="mat" id="materias">
                <option>PES</option>
                <option>PEC</option>
            </select>
        </div>
        <div id="footer">

        </div>
    </body>
</html>
