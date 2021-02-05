<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;

class SucursalesController extends Controller
{
    public function index(){
        if(Auth::user()->type_of_user != 'G')
            return "No tiene permisos para esta funcionalidad.";

        return View::make('sucursales.index');
    }

    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" => Sucursal::all()
        ));
    }

    public function actualizar(Request $request){
        $retorno = null;
        if(!isset($request->nombre_empresa) || strlen($request->nombre_empresa) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Captura el nombre",
                "sucursal" => null
            );
        }
        if(strlen(trim($request->nombre_empresa)) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El contenido debe tener maximo 50 caracteres",
                "sucursal" => null
            );
        }

        if(!isset($request->direccion) || strlen($request->direccion) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Captura el direccion",
                "sucursal" => null
            );
        }
        if(strlen(trim($request->direccion)) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El direccion debe tener maximo 50 caracteres",
                "sucursal" => null
            );
        }
        if(!isset($request->capital) || strlen($request->capital) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Ingrese el Capital",
                "sucursal" => null
            );
        }

        if(!isset($request->capitalInicial) || strlen($request->capitalInicial) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Ingrese el Capital Inicial",
                "sucursal" => null
            );
        }
        
        if(!isset($request->id_sucursal) || strlen($request->id_sucursal) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Debe ingresar el ID de la Sucursal",
                "sucursal" => null
            );
        }

        $sucursal = Sucursal::where('id_sucursal', $request->id_sucursal)->first();
        if(!isset($sucursal)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "La sucursal no existe",
                "sucursal" => null
            );
        }
        if(isset($retorno)){
            return json_encode($retorno);
        }

        $sucursal->nombre_empresa = trim($request->nombre_empresa);
        $sucursal->capital = trim($request->capital);
        $sucursal->capitalInicial = trim($request->capitalInicial);
        $sucursal->direccion = trim($request->direccion);
        //$sucursal->telefono = trim($request->telefono);
        $sucursal->save();

        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "Sucursal actualizada correctamente.",
            "sucursal" => $sucursal
        ));
    }


    public function crear(Request $request){
        $error=0;
        if(!isset($request->capital)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura el capital',
                "sucursal" => $request
            );
            $error=1;
        }
        if(strlen($request->nombre_empresa) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'El nombre debe contener máximo 50 caracteres',
                "sucursal" => null
            );
            $error=1;
        }
        if(strlen($request->direccion) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje"  => 'Captura la direccion',
                "sucursal" => null
            );
            $error=1;
        }
        if($error==1){
            return json_encode($retorno);
        }else{
            $sucursal = new Sucursal();
            $sucursal->capital = (float) trim($request->capital);
            $sucursal->capitalInicial = (float) trim($request->capitalInicial);
            $sucursal->nombre_empresa = trim($request->nombre_empresa);
            $sucursal->direccion = trim($request->direccion);
            
            $sucursal->save();
            
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Se guardo el registro',
                "sucursal" => $sucursal
            );
            return json_encode($retorno);
        }
    }
}

