<?php

namespace App\Http\Controllers;

use App\Models\Oficio;
use Illuminate\Http\Request;

class OficioController extends Controller
{
    public function mostrarTodo()
    {
        $oficios = Oficio::get();
        return response()->json($oficios);
    }
    public function crear(Request $request)
    {
        Oficio::create([
            'descripcion' => $request->descripcion,
        ]);
        return response()->json(["resp" => "Oficio creado correctamente"]);
    }
    public function eliminar($id)
    {
        $oficios = Oficio::find($id);
        if (!$oficios) {
            return response()->json(['error' => 'Oficio no encontrado'], 404);
        }
        $oficios->delete();
        return response()->json(['mensaje' => 'Oficio eliminado correctamente']);
    }
    public function actualizar(Request $request, $id)
    {
        $oficios = Oficio::find($id);
        if (!$oficios) {
            return response()->json(['error' => 'Oficio no encontrado'], 404);
        }
        $oficios->update([
            'descripcion' => $request->descripcion,
        ]);
        return response()->json(['mensaje' => 'Oficio actualizado correctamente']);
    }
}