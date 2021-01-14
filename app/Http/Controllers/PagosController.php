<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;



class PagosController extends Controller
{
    public function index (Request $request){
        return View::make('pagos.PagosIndex');
    }
}