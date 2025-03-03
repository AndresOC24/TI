<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class HorarioEspecial extends Model
{
    use HasFactory,HasRoles;

    protected $table = 'horario_especiales';

    protected $fillable = [
        'user_id',
        'fecha',
        'ingreso',
        'salida',
        'motivo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

