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
        'hora_evento_inicio',
        'hora_evento_fin',   
        'cantidad_invitados',
        'proposito',
        'autorizado_por',
        'rechazado_por' ,
    ];

    public function paquete(){
        return $this->belongsTo(Paquete::class, 'id_paquete');
    }

    use HasFactory;
    
}
