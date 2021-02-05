<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\TipoPago;
use App\Models\Prestamos;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    public function index (Request $request){
        $metodosPago = TipoPago::where('activo', true)->get();
        
        return View::make('pagos.PagosIndex', compact(['metodosPago']));
    }
    public function listar(Request $request){
        $consulta = Pagos::join('clientes AS c', 'pagos.id_cliente', '=', 'c.id_cliente')
        ->select('pagos.*', 'c.nombre AS nombreCliente')
        ->where('c.nombre', 'LIKE', "%{$request->busqueda}%")
        ->orWhere('pagos.monto', 'LIKE', "%{$request->busqueda}%")
        ->paginate(7);

        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" =>  $consulta
        ));
    }

    public function guardar(Request $request){

        /*
        {
            id_cliente: 0,
            id_metodo_pago: 0,
            monto: 0
        }
        */

        $prestamo = Prestamos::where('id_cliente', $request->id_cliente)
        ->where('saldo', '>', 0)->first();

        if(!isset($prestamo)){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje" => "El Cliente no tiene prestamos a lo que abonar."
            ));
        }

        if((float) $prestamo->saldo < (float) $request->monto){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje" => "No se puede abonar más del saldo del cliente."
            ));
        }

        $prestamo->saldo = (float) $prestamo->saldo - (float) $request->monto;
        $pago = new Pagos();
        $pago->id_cliente = $request->id_cliente;
        $pago->id_prestamo = $prestamo->id_prestamo;
        $pago->fecha_pago = \Carbon\Carbon::now();
        $pago->id_sucursal = Auth::user()->id_sucursal;
        $pago->id_usuario = Auth::user()->id;
        $pago->monto = (float) $request->monto;
        $pago->restante = $prestamo->saldo;
        $pago->save();
        $prestamo->save();
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "Pago realizado correctamente."
        ));
    }

}