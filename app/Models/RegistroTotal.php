<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroTotal extends Model
{
    use HasFactory;

    protected $table = 'registro_totales';

    protected $fillable = [
        'user_id',
        'total_tiempo',
        'saldo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
