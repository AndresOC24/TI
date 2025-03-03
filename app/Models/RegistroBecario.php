<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class RegistroBecario extends Model
{
    use HasFactory,HasRoles;

    protected $table = 'registro_becarios';

    protected $fillable = [
        'user_id',
        'horas_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
