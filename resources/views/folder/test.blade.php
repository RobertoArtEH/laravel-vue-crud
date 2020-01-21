<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"></link>
</head>
<body>
    <!-- <form action="data" method="post">
        @csrf
        <input type="text" name="nombre" class="form-control">
        <input type="text" name="apellidos" class="form-control">
        <input type="text" name="sexo" class="form-control">
        <button class="btn btn-primary">Enviar</button>
    </form> -->

    <main id="app">
        <example-component data="{{ json_encode($data) }}"></example-component>
    </main>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>