<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\TipoPago;

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

}