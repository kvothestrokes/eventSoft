<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paqueteservicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'paquete_id',
        'servicio_id',
    ];

    public function paquete()
    {
        return $this->belongsTo(Paquete::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    
}
