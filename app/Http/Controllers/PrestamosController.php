<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamos;
use Illuminate\Support\Facades\View;
use Session;
use Illuminate\Support\Facades\Storage;

class PrestamosController extends Controller
{
    public function index(){
        return View::make('prestamos.index');
    }
}
