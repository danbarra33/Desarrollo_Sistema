<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamos;
use Illuminate\Support\Facades\View;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Pagos;
use Illuminate\Support\Facades\Auth;

class PrestamosController extends Controller
{
    public function index(){
        return View::make('prestamos.index');
    }

    public function listado(Request $request){
        //{"id_prestamo":1,"id_cliente":23,"nombreCliente":"pedro picapiedra","monto_prestamo":100,"saldo":23,"status":"Vigente"}

        $consulta = Prestamos::join('clientes AS c', 'prestamos.id_cliente', '=', 'c.id_cliente')
        ->select('prestamos.id_prestamo', 'prestamos.id_cliente', 'c.nombre AS nombreCliente', 'prestamos.monto_prestamo', 'prestamos.saldo', 'prestamos.status', 'prestamos.plazo', 'prestamos.fecha_prestamo')
        ->orWhere('c.nombre', 'LIKE', "%{$request->busqueda}%")
        ->orWhere('prestamos.saldo', 'LIKE', "%{$request->busqueda}%")
        ->orWhere('prestamos.monto_prestamo', 'LIKE', "%{$request->busqueda}%")
        ->paginate(7);

        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" =>  $consulta
        ));
    }

    public function guardar(Request $request){

        $prestamo = new Prestamos();

        $prestamo->id_sucursal = Auth::user()->id_sucursal;
        $prestamo->id_cliente = $request->id_cliente;
        $prestamo->id_usuario = Auth::user()->id;
        $prestamo->fecha_prestamo	 = \Carbon\Carbon::now();
        $prestamo->monto_prestamo = $request->monto;
        $prestamo->interes_prestamo = $request->interes;
        $prestamo->saldo = $request->total;
        $prestamo->plazo = $request->plazo;
        $prestamo->status = $request->estatus;
        $prestamo->total_a_pagar = $request->total;
        $prestamo->pago_quincenal = $request->quincenal;
        $prestamo->ganancia = (float) $prestamo->total_a_pagar - (float) $prestamo->monto_prestamo;
        $prestamo->save();
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "Prestamo solicitado correctamente"
        ));
    }

}
