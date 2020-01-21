<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PruebaController extends Controller
{
    public function index() {
        $data = array([
            'nombre' => 'Roberto',
            'apellidos' => 'Esqueda',
            'sexo' => 'M',
            'edad' => 19
        ],
        [
            'nombre' => 'Andrés',
            'apellidos' => 'Estrada',
            'sexo' => 'M',
            'edad' => 20
        ],
        [
            'nombre' => 'Eliud',
            'apellidos' => 'Loza',
            'sexo' => 'M',
            'edad' => 19
        ],
        [
            'nombre' => 'Sara',
            'apellidos' => 'Lopez',
            'sexo' => 'F',
            'edad' => 20
        ]);

        return view('folder.test', ['data' => $data]);
    }

    public function prueba(Request $request, int $edad = null, string $sexo = "Masculino", string $nombre = "Juan") {
        return view('folder.test', \compact("nombre", "sexo", "edad"));
    }
}
