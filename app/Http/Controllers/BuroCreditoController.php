<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuroCredito;
use Illuminate\Support\Facades\View;







class BuroCreditoController extends Controller{

    public function index(){
        return View::make('BuroCredito.index');
    }
    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "buro" => BuroCredito::all()
        ));
    }

    public function actualizar(Request $request){
        $error=0;
        if(!isset($request->id_cliente )){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura el cliente',
                "buro" => $request
            );
            $error=1;
        }
        if(!isset($request->fecha_ingreso)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'captura la fecha',
                "buro" => null
            );
            $error=1;
        }
        if(!isset($request->SaldoDeudor)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'captura el adeudo',
                "buro" => null
            );
            $error=1;
        }
        if(!isset($request->status)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'captura el estatus',
                "buro" => null
            );
            $error=1;
        }

        $buro = BuroCredito::where('id_cliente ', $request->id_cliente)->first();
        if(!isset($buro)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El cliente no existe",
                "cliente" => null
            );
            $error=1;
        }
        if($error==1){
            return json_encode($retorno);
        }else{
            $buro->fecha_ingreso  = trim($request->fecha_ingreso);;
            $buro->SaldoDeudor    = trim($request->SaldoDeudor);
            $buro->status     = trim($request->status);;
            
            $buro->save();
            
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Se guardo el registro',
                "buro" => $buro
            );
            return json_encode($retorno);
        }

    }

    public function nuevo(Request $request){
        $error=0;
        if(!isset($request->id_cliente )){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura el cliente',
                "buro" => $request
            );
            $error=1;
        }
        if(!isset($request->SaldoDeudor) || strlen($request->SaldoDeudor) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura la Deuda',
                "buro" => null
            );
            $error=1;
        }
        if($error==1){
            return json_encode($retorno);
        }else{
            $buro = new BuroCredito();
            $buro->id_cliente = (float) trim($request->capital);
            $buro->fecha_ingreso  = date("Y-m-d H:i:s");
            $buro->SaldoDeudor    = trim($request->SaldoDeudor);
            $buro->status     = '1';
            
            $buro->save();
            
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Se guardo el registro',
                "buro" => $buro
            );
            return json_encode($retorno);
        }
    }

    
    
}
