<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paqueteservicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paquete',
        'id_servicio',
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'id_paquete', 'id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id');
    }
}
