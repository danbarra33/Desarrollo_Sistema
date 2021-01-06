<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aval extends Model
{
    use HasFactory;

    protected $table = 'avales';
    protected $primaryKey = 'id_aval';
    public $timestamps = false;
}