<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class PruebaController extends Controller
{
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
            try {
                $person->save();
    
                return response()->json($person);
            } catch(\Exception $e) {
                return response()->json($e);
            }
        }
        
        try {
            $person->save();

            return back();
        } catch(\Exception $e) {
            return $e;
        }

        return response()->json(null, 422);
    }

    public function dataUpdate(UserRequest $request, $id) {
        $validated = $request->validated();
        
        $person = \App\Models\Person::findOrFail($id);
        $person->nombre = $request->nombre;
        $person->apellidos = $request->apellidos;
        $person->sexo = $request->sexo;
        $person->edad = $request->edad;

        if($request->ajax()){

            try {
                $person->save();
    
                return response()->json($person);
            } catch(\Exception $e) {
                return response()->json($e);
            }
        }
        
        try {
            $person->save();

            return back();
        } catch(\Exception $e) {
            return $e;
        }

        return response()->json(null, 422);
    }

    public function dataDelete(Request $request, $id) {
        $person = \App\Models\Person::findOrFail($id);
        
        if($request->ajax()){
            try {
                $person->forceDelete();
    
                return response()->json($person);
            } catch(\Exception $e) {
                return response()->json($e);
            }
        }

        try {
            $person->forceDelete();

            return back();
        } catch(\Exception $e) {
            return $e;
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
