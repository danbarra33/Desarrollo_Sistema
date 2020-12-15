<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\View;
use Session;

class ClientesController extends Controller
{
    public function listado(Request $request){
        $clientes = Cliente::all();
        return View::make('clients.listado', compact(['clientes']));
    }

    public function editar(Request $request){
        if(!isset($request->id)){
            Session::flash('message', 'No se proporcionó el id del cliente'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        $cliente = Cliente::where('id_cliente', $request->id)->first();
        if(!isset($cliente)){
            Session::flash('message', 'El cliente no existe'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        
        return View::make('clients.editar', compact(['cliente']));
    }

    public function actualizar(Request $request){

        $retorno = null;
        if(!isset($request->nombre) || strlen($request->nombre) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "Debe igresar el nombre del cliente",
                "cliente" => null
            );
        }
        if(strlen(trim($request->nombre)) > 45){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "el nombre debe ser menor que 45 caracteres",
                "cliente" => null
            );
        }

        if(!isset($request->telefono) || strlen($request->telefono) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "ingrese el telefono",
                "cliente" => null
            );
        }
        if(strlen(trim($request->telefono)) > 10){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "el telefono debe ser menor de 10 numeros",
                "cliente" => null
            );
        }
        if(!isset($request->domicilio) || strlen($request->domicilio) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "ingrese el domicilio",
                "cliente" => null
            );
        }
        if(strlen(trim($request->domicilio)) > 50){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "el domicilio debe ser menor de 50 caracteres",
                "cliente" => null
            );
        }
        if(!isset($request->folioINE) || strlen($request->folioINE) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "ingrese la INE",
                "cliente" => null
            );
        }
        if(strlen(trim($request->folioINE)) > 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "la Ine debe ser menor de 13 caracteres",
                "cliente" => null
            );
        }
        if(!isset($request->Salario) || strlen($request->Salario) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "ingrese el salario",
                "cliente" => null
            );
        }
        if(!isset($request->status) || strlen($request->status) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "ingrese el estatus",
                "cliente" => null
            );
        }
        if(strlen(trim($request->status)) > 13){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "el estatus debe ser menor de 13 caracteres",
                "cliente" => null
            );
        }

        if(!isset($request->id) || strlen($request->id) == 0){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "ingrese el id",
                "cliente" => null
            );
        }


        $cliente = Cliente::where('iD_Cliente', $request->id)->first();
        if(!isset($cliente)){
            $retorno = (object) array(
                "codigo" => 0,
                "mensaje" => "El cliente no existe",
                "cliente" => null
            );
        }
        if(isset($retorno)){
            return json_encode($retorno);
        }

        $cliente->nombre = trim($request->nombre);
        $cliente->folio_INE = trim($request->folioINE);
        $cliente->direccion = trim($request->domicilio);
        $cliente->telefono = trim($request->telefono);
        $cliente->status = trim($request->status);
        $cliente->salario_Mensual = (float) trim($request->Salario);
        $cliente->save();

        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "cliente actualizado correctamente.",
            "cliente" => $cliente
        ));

       
    }

    public function nuevo(Request $request){

        if(!isset($request->nombre) || strlen($request->nombre) == 0){
            Session::flash('message', 'Captura el nombre'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(strlen(trim($request->nombre)) > 45){
            Session::flash('message', 'El nombre debe contener máximo 45 caracteres'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }

        if(!isset($request->telefono) || strlen($request->telefono) == 0){
            Session::flash('message', 'Captura el telefono'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(strlen(trim($request->telefono)) > 10){
            Session::flash('message', 'El telefono debe contener máximo 10 caracteres'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(!isset($request->domicilio) || strlen($request->domicilio) == 0){
            Session::flash('message', 'Captura el domicilio'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(strlen(trim($request->domicilio)) > 50){
            Session::flash('message', 'El domicilio debe contener máximo 50 caracteres'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(!isset($request->folioINE) || strlen($request->folioINE) == 0){
            Session::flash('message', 'Captura el Folio INE'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(strlen(trim($request->folioINE)) > 13){
            Session::flash('message', 'El Folio INE debe contener máximo 13 caracteres'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(!isset($request->Salario) || strlen($request->Salario) == 0){
            Session::flash('message', 'Captura el Salario'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(!isset($request->status) || strlen($request->status) == 0){
            Session::flash('message', 'Captura el Estatus'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        if(strlen(trim($request->status)) > 13){
            Session::flash('message', 'El Estatus debe contener máximo 1 caracter'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        
        $cliente = new Cliente();
        $cliente->nombre = trim($request->nombre);
        $cliente->folio_INE = trim($request->folioINE);
        $cliente->direccion = trim($request->domicilio);
        $cliente->telefono = trim($request->telefono);
        $cliente->status = trim($request->status);
        $cliente->salario_Mensual = (float) trim($request->Salario);
        $cliente->save();

        Session::flash('message', 'Cliente registrado correctamente.'); 
        Session::flash('alert-type', 'info');
        return redirect('/clientes');
    }
}
