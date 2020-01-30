<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class PruebaController extends Controller
{
    public function createToken() {
        return 'a';
    }

    public function index() {
        $data = \App\Models\Person::all()->toArray();

        return view('folder.test', ['data' => $data]);
    }

    public function data(UserRequest $request) {
        $validated = $request->validated();

        $person = new \App\Models\Person();
        $person->nombre = $request->nombre;
        $person->apellidos = $request->apellidos;
        $person->sexo = $request->sexo;
        $person->edad = $request->edad;

        if($request->ajax()) {
            $person->save();

            return response()->json($request->all());
        }

        if($person->save())
            return back();

        return response()->json(null, 422);
    }

    public function dataUpdate(UserRequest $request, $id) {
        $validated = $request->validated();
        
        if($request->ajax()){
            $person = \App\Models\Person::findOrFail($id);
            $person->nombre = $request->nombre;
            $person->apellidos = $request->apellidos;
            $person->sexo = $request->sexo;
            $person->edad = $request->edad;
            $person->save();

            return response()->json($request->all());
        }
        
        $person = \App\Models\Person::findOrFail($id);
        $person->nombre = $request->nombre;
        $person->apellidos = $request->apellidos;
        $person->sexo = $request->sexo;
        $person->edad = $request->edad;

        if($person->save()) {
            return back();
        }

        return response()->json(null, 422);
    }

    public function dataDelete(Request $request, $id) {
        if($request->ajax()){
            $person = \App\Models\Person::findOrFail($id);
            $person->forceDelete();

            return response()->json($request->all());
        }
        
        $person = \App\Models\Person::findOrFail($id);

        if($person->forceDelete()) {
            $data = \App\Models\Person::all()->toArray();

            return back()->with(['data' => $data]);
        }

        return response()->json(null, 422);
    }

    // Métodos con Sessions
    public function add(Request $request) {
        $request->validate([
            "nombre"=>"required|string",
            "apellidos"=>"required|string",
            "sexo"=>"required|string",
            "edad"=>"required|integer"
        ]);

        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $sexo = $request->input('sexo');
        
        $alumno = ['nombre' => $nombre, 'apellidos' => $apellidos, 'sexo' => $sexo];

        $request->session()->push('lista.alumnos', $alumno);
        
        return back()->with(['data' => $request->all()]);
    }

    public function delete(Request $request, $id) {
        $index = $id - 1;
        
        $list = session()->get('lista.alumnos');
        
        array_splice($list, $index, 1);        
        session()->put('lista.alumnos', $list);

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

        return back()->with(['data' => $request->all()]);
    }

    public function prueba(Request $request, int $edad = null, string $sexo = "Masculino", string $nombre = "Juan") {
        return view('folder.test', \compact("nombre", "sexo", "edad"));
    }
}
