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
        $cliente = Cliente::where('iD_Cliente', $request->id)->first();
        if(!isset($cliente)){
            Session::flash('message', 'El cliente no existe'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }
        
        return View::make('clients.editar', compact(['cliente']));
    }

    public function actualizar(Request $request){
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

        if(!isset($request->id) || strlen($request->id) == 0){
            Session::flash('message', 'Debe proporcionar el id del cliente'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }

        $cliente = Cliente::where('iD_Cliente', $request->id)->first();
        if(!isset($cliente)){
            Session::flash('message', 'El cliente debe proporcionado no existe'); 
            Session::flash('alert-type', 'warning');
            return back()->withInput();
        }

        $cliente->Nombre = trim($request->nombre);
        $cliente->Folio_INE = trim($request->folioINE);
        $cliente->Direccion = trim($request->domicilio);
        $cliente->Telefono = trim($request->telefono);
        $cliente->Status = trim($request->status);
        $cliente->Salario_Mensual = (float) trim($request->Salario);
        $cliente->save();

        Session::flash('message', 'Cliente actualizado correctamente.'); 
        Session::flash('alert-type', 'info');
        return redirect('/clientes');
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
        $cliente->Nombre = trim($request->nombre);
        $cliente->Folio_INE = trim($request->folioINE);
        $cliente->Direccion = trim($request->domicilio);
        $cliente->Telefono = trim($request->telefono);
        $cliente->Status = trim($request->status);
        $cliente->Salario_Mensual = (float) trim($request->Salario);
        $cliente->save();

        Session::flash('message', 'Cliente registrado correctamente.'); 
        Session::flash('alert-type', 'info');
        return redirect('/clientes');
    }
}
