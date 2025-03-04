<?php

namespace App\Policies;

use App\Models\RegistroBecario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RegistroBecarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user -> hasRole(['Administrador','Becario']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RegistroBecario $registroBecario): bool
    {
        return $user -> hasRole(['Administrador','Becario']);
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
    public function update(User $user, RegistroBecario $registroBecario): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RegistroBecario $registroBecario): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RegistroBecario $registroBecario): bool
    {
        return $user -> hasRole('Administrador');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RegistroBecario $registroBecario): bool
    {
        return $user -> hasRole('Administrador');
    }
}
