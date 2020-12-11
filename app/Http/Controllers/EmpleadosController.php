<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\Empleado;

class EmpleadosController extends Controller
{
    public function index(){
        return View::make('empleados.index');
    }

    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" => Empleado::all()
        ));
    }
    /*
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
    */
}