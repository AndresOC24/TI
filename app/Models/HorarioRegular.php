<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class HorarioRegular extends Model
{
    use HasFactory,HasRoles;

    protected $table = 'horario_regulares';

    protected $fillable = [
        'user_id',
        'ingreso',
        'salida',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
