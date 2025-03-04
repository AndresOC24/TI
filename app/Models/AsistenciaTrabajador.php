<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class AsistenciaTrabajador extends Model
{
    use HasFactory,HasRoles;

    protected $table = 'asistencia_trabajadores';

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
