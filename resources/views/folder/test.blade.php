<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"></link>
</head>
<style>
    .M {
        background: #0984e3;
        color: #fff;
    }

    .F {
        background: #fd79a8;
        color: #fff;
    }
</style>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-danger text-center">Sync Form - Blade</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="data" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" name="apellidos" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sexo">Sexo (M/F)</label>
                                        <input type="text" name="sexo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="edad">Edad</label>
                                        <input type="number" name="edad" class="form-control">
                                    </div>
                                    <button class="btn btn-danger btn-block">Enviar</button>
                                </form>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Acciónes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i=0; $i < (count($data)); $i++)
                                            <tr class="{{ $data[$i]['sexo'] }}">
                                                <th>{{ $data[$i]['nombre'] }}</th>
                                                <th>{{ $data[$i]['apellidos'] }}</th>
                                                <th>
                                                    <input class="btn btn-danger" type="submit" value="Editar" data-toggle="modal" data-target="#modal{{ $i }}" data-whatever="@mdo">
                                                        <!-- Modal de Editar -->
                                                        <div class="modal fade" id="modal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="{{ $i }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-dark" id="{{ $i }}">Editar</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('dataUpdate', $data[$i]['id'])}}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="nombre" class="col-form-label text-dark">Nombre:</label>
                                                                    <input name="nombre" type="text" class="form-control" value="{{ $data[$i]['nombre'] }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="apellidos" class="col-form-label text-dark">Apellidos:</label>
                                                                    <input name="apellidos" class="form-control" value="{{ $data[$i]['apellidos'] }}"></input>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sexo" class="col-form-label text-dark">Sexo:</label>
                                                                    <input name="sexo" type="text" class="form-control" value="{{ $data[$i]['sexo'] }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edad" class="col-form-label text-dark">Edad:</label>
                                                                    <input name="edad" type="number" class="form-control" value="{{ $data[$i]['edad'] }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Editar</button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <form action="{{route('dataDelete' , $data[$i]['id'])}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input class="btn btn-danger" type="submit" value="Borrar">
                                                    </form>
                                                </th>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main id="app">
        <example-component data="{{ json_encode($data) }}"></example-component>
    </main>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>