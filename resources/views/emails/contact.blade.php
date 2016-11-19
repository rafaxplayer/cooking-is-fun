<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Mensage enviado por: {{$name}} desde Cooking is Fun</h2>
        Email:<label>{{$email}}</label>
        Mensage:<p>{!!nl2br($mess)!!}</p>
    </body>
</html>