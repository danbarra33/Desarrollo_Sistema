<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuroCredito extends Model
{
    use HasFactory;

    protected $table = 'buro_credito_interno';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;
}