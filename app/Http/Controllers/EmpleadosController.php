<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\Empleado;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmpleadosController extends Controller
{
    public function index(){
        if(Auth::user()->type_of_user != 'G')
            return "No tiene permisos para esta funcionalidad.";

        $sucursales = Sucursal::all();
        return View::make('empleados.index', compact(['sucursales']));
    }

    public function listado(Request $request){
        return json_encode((object) array(
            "codigo" => 1,
            "mensaje" => "",
            "listado" => Empleado::all()
        ));
    }

    public function actualizar(Request $request){

        if(strlen($request->name) == 0 || strlen($request->name) > 255){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture el nombre del empleado.',
                "empleado" => null
            ));
        }

        if(strlen($request->address) == 0 || strlen($request->address) > 255){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture el domicilio del empleado.',
                "empleado" => null
            ));
        }

        if(strlen($request->phone) == 0 || strlen($request->phone) > 10){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture un telefono válido.',
                "empleado" => null
            ));
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL))
        {
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture un correo válido.',
                "empleado" => null
            ));
        }

        if(strlen($request->password) > 255){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture la contraseña.',
                "empleado" => null
            ));
        }

        if(strlen($request->id_sucursal) == 0 || $request->id_sucursal == 0){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture la sucursal.',
                "empleado" => null
            ));
        }

        if(strlen($request->type_of_user) == 0){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture el tipo de usuario.',
                "empleado" => null
            ));
        }

        $user = User::where('id', $request->id)->first();

        if(!isset($user)){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'El usuario no existe.',
                "empleado" => null
            ));
        }

        if(count(User::where('email', $request->email)->where('id', '<>', $request->id)->get()) > 0){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'El correo ya está registrado en otro empelado.',
                "empleado" => null
            ));
        }

        $user->name = $request->name;

        if(strlen($request->password) > 0){
            $user->password = Hash::make($request->password);
        }

        $user->email = $request->email;
        $user->id_sucursal = $request->id_sucursal;
        $user->type_of_user = $request->type_of_user;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return json_encode((object) array(
            "codigo" => 1,
            "mensaje"  => 'Se actualizó el registro',
            "empleado" => $user
        ));
    }

    public function crear(Request $request){
        /*
            id: 0,
            name: '',
            address: '',
            phone: '',
            email: '',
            password: '',
            id_sucursal: 0,
            type_of_user: ''
        */
        if(strlen($request->name) == 0 || strlen($request->name) > 255){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture el nombre del empleado.',
                "empleado" => null
            ));
        }

        if(strlen($request->address) == 0 || strlen($request->address) > 255){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture el domicilio del empleado.',
                "empleado" => null
            ));
        }

        if(strlen($request->phone) == 0 || strlen($request->phone) > 10){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture un telefono válido.',
                "empleado" => null
            ));
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL))
        {
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture un correo válido.',
                "empleado" => null
            ));
        }

        if(strlen($request->password) < 1 || strlen($request->password) > 255){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture la contraseña.',
                "empleado" => null
            ));
        }

        if(strlen($request->id_sucursal) == 0 || $request->id_sucursal == 0){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture la sucursal.',
                "empleado" => null
            ));
        }

        if(strlen($request->type_of_user) == 0){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'Capture el tipo de usuario.',
                "empleado" => null
            ));
        }

        if(count(User::where('email', $request->email)->get()) > 0){
            return json_encode((object) array(
                "codigo" => 0,
                "mensaje"  => 'El correo ya está registrado en otro empelado.',
                "empleado" => null
            ));
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = trim($request->email);
        $user->id_sucursal = $request->id_sucursal;
        $user->type_of_user = $request->type_of_user;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return json_encode((object) array(
            "codigo" => 1,
            "mensaje"  => 'Se guardo el registro',
            "empleado" => $user
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