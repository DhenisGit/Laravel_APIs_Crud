<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function mostrarTodo()
    {
        $personas = Persona::get();
        return response()->json($personas);
    }
    public function crear(Request $request)
    {
        Persona::create([
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombre' => $request->nombre,
            'celular' => $request->celular
        ]);
        return response()->json(["resp" => "persona creada correctamente"]);
    }
    public function eliminar($id)
    {
        $personas = Persona::find($id);
        if (!$personas) {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }
        $personas->delete();
        return response()->json(['mensaje' => 'Persona eliminado correctamente']);
    }
    public function actualizar(Request $request, $id)
    {
        $persona = Persona::find($id);
        if (!$persona) {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }
        $persona->update([
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombre' => $request->nombre,
            'celular' => $request->celular,
        ]);
        return response()->json(['mensaje' => 'Persona actualizada correctamente']);
    }
}