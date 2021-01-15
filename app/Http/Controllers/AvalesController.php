<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\Aval;

class AvalesController extends Controller
{
    public function index(){
        return View::make('avales.index');
    }

    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" => Aval::all()
        ));
    }

    public function crear(Request $request){
        $error=0;
        if(!isset($request->id_cliente) || $request->id_cliente == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un Cliente',
                "aval" => $request
            );
            $error=1;
        }
        if(strlen($request->nombre) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese el nombre del Aval',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->direccion) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura la direccion',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->direccion) >= 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'La dirección no debe superar los 50 caracteres',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->folio_ine) < 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un Folio INE Valido',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->folio_ine) > 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un Folio INE Valido',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->curp) < 18){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese una CURP Valida',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->curp) > 18){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese una CURP Valida',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->rfc) < 12){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un RFC Valido',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->rfc) > 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un RFC Valido',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->telefono) > 10){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un numero telefonico Valido',
                "aval" => null
            );
            $error=1;
        }
        if(strlen($request->telefono) < 10){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un numero telefonico Valido',
                "aval" => null
            );
            $error=1;
        }
        if($error==1){
            return json_encode($retorno);
        }else{
            $aval = new Aval();
            $aval->id_cliente = trim($request->id_cliente);
            $aval->nombre = trim($request->nombre);
            $aval->direccion = trim($request->direccion);
            $aval->folio_ine = trim($request->folio_ine);
            $aval->curp = trim($request->curp);
            $aval->rfc = trim($request->rfc);
            $aval->telefono = trim($request->telefono);
            
            $aval->save();
            
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Se guardo el registro',
                "aval" => $aval
            );
            return json_encode($retorno);
        }

    }
    
    public function actualizar(Request $request)
    {
        if(!isset($request->id_aval)){                     
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje" => "proporcione el id del aval.",
            ));
        }

        $aval = Aval::where('id_aval', $request->id_aval)->first();
        if(!isset($aval)){
            //No existe el aval
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje" => "El aval no existe.",
            ));
        }
        
        $error=0;
        if(!isset($request->id_cliente) || $request->id_cliente == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un Cliente',
            );
            $error=1;
        }
        if(strlen($request->nombre) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese el nombre del Aval',
            );
            $error=1;
        }
        if(strlen($request->direccion) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura la direccion',
            );
            $error=1;
        }
        if(strlen($request->direccion) >= 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'La dirección no debe superar los 50 caracteres',
            );
            $error=1;
        }
        if(strlen($request->folio_ine) < 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un Folio INE Valido',
            );
            $error=1;
        }
        if(strlen($request->folio_ine) > 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un Folio INE Valido',
            );
            $error=1;
        }
        if(strlen($request->curp) < 18){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese una CURP Valida',
            );
            $error=1;
        }
        if(strlen($request->curp) > 18){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese una CURP Valida',
            );
            $error=1;
        }
        if(strlen($request->rfc) < 12){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un RFC Valido',
            );
            $error=1;
        }
        if(strlen($request->rfc) > 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un RFC Valido',
            );
            $error=1;
        }
        if(strlen($request->telefono) > 10){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un numero telefonico Valido',
            );
            $error=1;
        }
        if(strlen($request->telefono) < 10){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Ingrese un numero telefonico Valido',
            );
            $error=1;
        }
        if($error==1){
            return json_encode($retorno);
        }else{

            //$aval->id_cliente = trim($request->id_cliente);
            $aval->nombre = trim($request->nombre);
            $aval->direccion = trim($request->direccion);
            $aval->folio_ine = trim($request->folio_ine);
            $aval->curp = trim($request->curp);
            $aval->rfc = trim($request->rfc);
            $aval->telefono = trim($request->telefono);
            
            $aval->save();
            
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Se actualizó el registro',
                "aval" => $aval
            );
            return json_encode($retorno);
        }
        
    }

}

