<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaBecario extends Model
{
    use HasFactory;

    protected $table = 'asistencia_becarios';

    protected $fillable = [
        'user_id',
        'fecha',
        'ingreso',
        'salida',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
