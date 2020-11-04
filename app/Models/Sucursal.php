<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'Sucursales';
    protected $primaryKey = 'ID_Sucursal';
    public $timestamps = false;
}
