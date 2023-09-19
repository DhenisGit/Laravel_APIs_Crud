<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function mostrarTodo()
    {
        $categorias = Categoria::get();
        return response()->json($categorias);
    }
    public function crear(Request $request)
    {
        Categoria::create([
            'descripcion' => $request->descripcion,
        ]);
        return response()->json(["resp" => "Categoria creada correctamente"]);
    }
    public function eliminar($id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }
        $categoria->delete();
        return response()->json(['mensaje' => 'Categoría eliminada correctamente']);
    }
    public function actualizar(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }
        $categoria->update([
            'descripcion' => $request->descripcion,
        ]);
        return response()->json(['mensaje' => 'Categoría actualizada correctamente']);
    }
}