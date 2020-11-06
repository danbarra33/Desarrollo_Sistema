<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\Sucursal;

class SucursalesController extends Controller
{


    public function index(){
        return View::make('sucursales.index');
    }

    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" => Sucursal::all()
        ));
    }

    public function editar(Request $request){

        $retorno = (object) array(
            "codigo" => 0,
            "mensaje" => "mensaje",
            "modelo" => null
        );

        if(!isset($request->id)){
            $retorno->mensaje = "Proporcione el id de la sucursal.";
            return json_encode($retorno);
        }
        $sucursal = Sucursal::where('ID_Sucursal', $request->id)->first();
        if(!isset($sucursal)){
            $retorno->mensaje = "Proporcione el id de la sucursal.";
            return json_encode($retorno);
        }
        
        $retorno->modelo = $sucursal;
        return json_encode($retorno);
    }

    public function actualizar(Request $request){
        if(!isset($request->nombre) || strlen($request->nombre) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Captura el nombre",
                "modelo" => null
            );
        }
        if(strlen(trim($request->nombre)) > 45){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El contenido debe tener maximo 45 caracteres",
                "modelo" => null
            );
        }

        if(!isset($request->direccion) || strlen($request->direccion) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Captura el domicilio",
                "modelo" => null
            );
        }
        if(strlen(trim($request->domicilio)) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El domicilio debe tener maximo 50 caracteres",
                "modelo" => null
            );
        }
        if(!isset($request->capital) || strlen($request->capital) <= 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Ingrese el Capital",
                "modelo" => null
            );
        }
        
        if(!isset($request->id) || strlen($request->id) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Debe ingresar el ID de la Sucursal",
                "modelo" => null
            );
        }

        $cliente = Cliente::where('ID_Sucursal', $request->id)->first();
        if(!isset($sucursal)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "La sucursal no existe",
                "modelo" => null
            );
        }

        $sucursal->Nombre_Empresa = trim($request->nombre);
        $sucursal->Capital = trim($request->capital);
        $sucursal->Direccion = trim($request->domicilio);
        $sucursal->Telefono = trim($request->telefono);
        $sucursal->save();

        Session::flash('message', 'Sucursal actualizadz correctamente.'); 
        Session::flash('alert-type', 'info');
        return redirect('/sucursal');
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
            $sucursal->nombre_empresa = $request->nombre_empresa;
            $sucursal->direccion = $request->direccion;
            
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

