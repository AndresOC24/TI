<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**Relaciones con las otras tablas */
    public function horarioRegular()
    {
        return $this->hasOne(HorarioRegular::class);
    }

    public function horariosEspeciales()
    {
        return $this->hasMany(HorarioEspecial::class);
    }

    public function asistenciaTrabajador()
    {
        return $this->hasMany(AsistenciaTrabajador::class);
    }

    public function asistenciaBecarios()
    {
        return $this->hasMany(AsistenciaBecario::class);
    }

    public function registroTotal()
    {
        return $this->hasOne(RegistroTotal::class);
    }

    public function registroBecario()
    {
        return $this->hasOne(RegistroBecario::class);
    }


}
