<?php

namespace App\Policies;

use App\Models\Mundo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MundoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mundo $mundo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Mundo $mundo): bool
    {
        // Usamos == para evitar errores de tipo de dato (string vs integer)
        if ($user->role == 'admin') {
            return true;
        }
        
        return $user->id == $mundo->user_id;
    }

    public function delete(User $user, Mundo $mundo): bool
    {
        if ($user->role == 'admin') {
            return true;
        }
        
        return $user->id == $mundo->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mundo $mundo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mundo $mundo): bool
    {
        return false;
    }
}
