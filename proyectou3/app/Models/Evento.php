<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nombre',
        'id_usuario',
        'id_paquete',
        'fecha_evento',   
        'estado',        
    ];

    public function paquete(){
        return $this->belongsTo(Paquete::class, 'id_paquete');
    }

    use HasFactory;
    
}
