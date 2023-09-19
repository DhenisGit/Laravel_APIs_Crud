<?php

namespace App\Http\Controllers\Gasto;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Local;
use App\Models\Persona;
use App\Models\Usuario\Administrador;
use App\Models\Usuario\Encargado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

/**
 * @group Gastos
 * APIs para Gastos.
 * RECOMENDADO: get, get/id, create, update/id, delete/id.
 *
 */
class GastoController extends Controller
{
    /**
     * Retornar mis gastos
     *
     * Retorna todos los gastos registrados.
     *
     * @urlParam idLocal  required id del local del que se quiere sacar los gastos
     *
     * @response {
     *   "data": [
     *       {
     *           "id": 1:,
     *           "local_id": 0:,
     *           "tipo_gasto_id:0,
     *           "metodo_pago_id:0,
     *           "fecha_gasto:"date",
     *           "valor:0.05,
     *       }
     *   ],
     *   "size": 1
     * }
     */
    public function index($nombre)
    {
        $gastos = Persona::where('nombre', $nombre)->with(['tipo_gasto','metodo_pago'])->where('estado_registro', 'A')->get();
        return response()->json(["data" => $gastos, "size" =>  count($gastos)]);
    }
    /**
     * Crear Persona
     *
     * Crea un gasto {"local_id":0,"tipo_gasto_id":0,"metodo_pago_id":0,"fecha_gasto":"2000-01-10","valor":"valor","estado_pago":1}
     *
     * @bodyParam  local_id integer required local.
     * @bodyParam  tipo_gasto_id integer tipo del gasto que se registra.
     * @bodyParam  metodo_pago_id metodo de pago dle registro.
     * @bodyParam  fecha_gasto date fecha en que se hizo el gasto.
     * @bodyParam  valor double valor del gasto.
     *
     * @response {
     *    "resp": "Persona creado correctamente"
     * }
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Persona::create([
                'descripcion' => $request->descripcion,
                'tipo_gasto_id' => $request->tipo_gasto_id == 0 ? null : $request->tipo_gasto_id,
                'metodo_pago_id' => $request->metodo_pago_id == 0 ? null : $request->metodo_pago_id,
                'fecha_gasto' => $request->fecha_gasto,
                'valor' => $request->valor
            ]);
            DB::commit();
            return response()->json(["resp" => "Persona creado correctamente"]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["error" => $e]);
        }
    }

    /**
     * Actualizar gasto
     *
     * Actualiza los datos de un gasto.
     *
     * @urlParam idGasto required Id de la deuda o gasto.
     *
     * @bodyParam  tipo_gasto_id integer tipo del gasto que se registra.
     * @bodyParam  metodo_pago_id metodo de pago dle registro.
     * @bodyParam  fecha_gasto date fecha en que se hizo el gasto.
     * @bodyParam  valor double valor del gasto.
     *
     *
     * @response {
     *    "resp": "Persona eliminado correctamente"
     * }
     */

    public function update(Request $request, $idGasto)
    {
        DB::beginTransaction();
        try {
            $gasto = Persona::where('estado_registro', 'A')->find($idGasto);
            $gasto->fill([
                'descripcion' => $request->descripcion,
                'tipo_gasto_id' => $request->tipo_gasto_id == 0 ? null : $request->tipo_gasto_id,
                'metodo_pago_id' => $request->metodo_pago_id == 0 ? null : $request->metodo_pago_id,
                'fecha_gasto' => $request->fecha_gasto,
                'valor' => $request->valor
            ])->save();
            DB::commit();
            return response()->json(["resp" => "Persona actualizado correctamente"]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["error" => $e]);
        }
    }
    /**
     * Eliminar gasto
     *
     * Eliminar un gasto.
     *
     * @urlParam idGasto required Id del gasto.
     *
     *
     * @response {
     *    "resp": "Persona eliminado correctamente"
     * }
     */

    public function delete($idGasto)
    {
        DB::beginTransaction();
        try {
            $gasto = Persona::where('estado_registro', 'A')->find($idGasto);
            $gasto->fill([
                'estado_registro' => 'I',
            ])->save();
            DB::commit();
            return response()->json(["resp" => "Persona eliminado correctamente"]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["error" => $e]);
        }
    }
}
