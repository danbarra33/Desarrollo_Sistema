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

    public function nuevo(Request $request){
        $retorno = null;

        if(!isset($request->tipo) || strlen($request->tipo) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Captura el tipo",
                "modelo" => null
            );
        }

        if(strlen(trim($request->tipo)) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El tipo debe tener maximo 50 caracteres",
                "modelo" => null
            );
        }

        if(isset($retorno)){
            return json_encode($retorno);
        }

        $tipoPago = new TipoPago();

        $tipoPago->tipo = trim($request->tipo);
        $tipoPago->activo = $request->activo;

        $tipoPago->save();

        $retorno = (object) array(
            "codigo" => 1,
            "mensaje" => "Método de pago creado correctamente.",
            "modelo" => $tipoPago
        );

        return json_encode($retorno);
    }

    public function actualizar(Request $request){
        $retorno = null;

        if(!isset($request->id_tipo_pago) || strlen($request->id_tipo_pago) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Debe proporcionar el ID del tipo de pago",
                "modelo" => null
            );
        }

        if(!isset($request->tipo) || strlen($request->tipo) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Captura el tipo",
                "modelo" => null
            );
        }

        if(strlen(trim($request->tipo)) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El tipo debe tener maximo 50 caracteres",
                "modelo" => null
            );
        }

        if(isset($retorno)){
            return json_encode($retorno);
        }

        $tipoPago = TipoPago::where('id_tipo_pago', $request->id_tipo_pago)->first();

        if(!isset($tipoPago)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El tipo de pago no existe.",
                "modelo" => null
            );
            return json_encode($retorno);
        }

        $tipoPago->tipo = trim($request->tipo);
        $tipoPago->activo = $request->activo;

        $tipoPago->save();

        $retorno = (object) array(
            "codigo" => 1,
            "mensaje" => "Método de pago actualizado correctamente.",
            "modelo" => $tipoPago
        );

        return json_encode($retorno);
    }

    public function borrar(Request $request){
        $retorno = null;

        if(!isset($request->id_tipo_pago) || strlen($request->id_tipo_pago) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Debe proporcionar el ID del tipo de pago",
                "modelo" => null
            );
        }

        $tipoPago = TipoPago::where('id_tipo_pago', $request->id_tipo_pago)->first();
        
        if(!isset($tipoPago)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El tipo de pago no existe.",
                "modelo" => null
            );
            return json_encode($retorno);
        }
        $tipoPago->delete();

        $retorno = (object) array(
            "codigo" => 1,
            "mensaje" => "Método de pago borrado correctamente.",
            "modelo" => $tipoPago
        );

        return json_encode($retorno);
    }

}
