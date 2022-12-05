<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class abono extends Model
{
    protected $fillable = [
        'id_evento',
        'monto',
    ];
    use HasFactory;
    
}
