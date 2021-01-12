<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $table = 'cat_tipos_pago';
    protected $primaryKey = 'id_tipo_pago';
    public $timestamps = false;
}
