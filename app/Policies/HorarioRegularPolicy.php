<?php

namespace App\Policies;

use App\Models\HorarioRegular;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HorarioRegularPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HorarioRegular $horarioRegular): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HorarioRegular $horarioRegular): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HorarioRegular $horarioRegular): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HorarioRegular $horarioRegular): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HorarioRegular $horarioRegular): bool
    {
        return $user -> hasRole('Administrador');
    }
}
