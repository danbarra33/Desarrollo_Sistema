<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPago;
use Illuminate\Support\Facades\View;

class TiposPagosController extends Controller
{

    public function index (Request $request){
        return View::make('pagos.tipos.index');
    }

    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" => TipoPago::all()
        ));
    }
}
