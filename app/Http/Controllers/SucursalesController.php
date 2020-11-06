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
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "Scursal creada correctamente.",
            "modelo" => null
        ));
    }

    public function guardar(Request $request){
        $error=0;
        if(!isset($request->Capital) || $request->Capital > 0){
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Captura el capital',
                "sucursal" => null
            );
            $error=1;
        }
        if(strlen($request->Nombre_Empresa) > 50){
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'El nombre debe contener máximo 50 caracteres',
                "sucursal" => null
            );
            $error=1;
        }
        if(strlen($request->Direccion) > 50){
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Captura la direccion',
                "sucursal" => null
            );
            $error=1;
        }
        if($error==1){
            return json_encode($retorno);
        }else{
            $sucursal = new Sucursal();
            $sucursal->Salario_Mensual = (float) trim($request->Capital);
            $sucursal->Nombre = $request->nombre;
            $sucursal->Direccion = $request->Direccion;
            
            $sucursal->save();
            
            $retorno = (object) array(
                "codigo" => 1,
                "mensaje"  => 'Captura la direccion',
                "sucursal" => $sucursal
            );
            return json_encode($retorno);
        }
    }
}

