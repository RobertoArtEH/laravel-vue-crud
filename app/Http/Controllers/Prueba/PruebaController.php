<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PruebaController extends Controller
{
    public function data(Request $request) {
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $sexo = $request->input('sexo');
        $alumnos = ['nombre' => $nombre, 'apellidos' => $apellidos, 'sexo' => $sexo];
        
        $request->session()->push('lista.alumnos', $alumnos);
        
        // return $request->all();
        // return view('folder.test')->with(['data' => $request->all()]);
        return back()->with(['data' => $request->all()]);
        // $data = $request->session()->get('alumno');
    }
    
    public function delete(Request $request, $id) {
        $index = $id - 1;
        session()->forget('lista.alumnos.'.$index);
        return back()->with(['data' => $request->all()]);
    }
    
    public function update(Request $request, $id) {
        $index = $id - 1;
        $obj = $request->session()->get('lista.alumnos');
        
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $sexo = $request->input('sexo');
        
        
        $obj[$index]['nombre'] = $nombre;
        $obj[$index]['apellidos'] = $apellidos;
        $obj[$index]['sexo'] = $sexo;
        
        session()->put('lista.alumnos', $obj);
        // return $request->session()->all();

        return back()->with(['data' => $request->all()]);
    }
    
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
