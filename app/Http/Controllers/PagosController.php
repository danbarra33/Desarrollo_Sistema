<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;



class PagosController extends Controller
{
    public function index (Request $request){
        return View::make('pagos.PagosIndex');
    }
    public function listar(Request $request){

        $consulta = Pagos::join('clientes AS c', 'pagos.id_cliente', '=', 'c.id_cliente')
        ->select('pagos.*', 'c.nombre AS nombreCliente')
        ->get();


        // $arrListarPagos = \DB::table('pagos')
        //     ->join('clientes', 'pagos.id_cliente ', '=', 'clientes.id_cliente')
        //     ->select('pagos.*')
        //     ->get();
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" =>  $consulta
        ));
    }

}