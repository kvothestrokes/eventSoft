<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{

    protected $fillable = [
        'nombre',                
        'descripcion',
        'precio',
        'imagen',            
    ];



    use HasFactory;
}
