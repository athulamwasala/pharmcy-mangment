<?php

namespace App\Policies;

use App\Models\Medication;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicationPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->role === 'owner') {
            return true; // Allow owners to perform any action
        }
    }

    public function viewAny(User $user)
    {
        return true; // All users can view medication records
    }

    public function create(User $user)
    {
        return false; // By default, no one can create medication records
    }

    public function update(User $user)
    {
    
        return  $user->role === 'owner' ||  $user->role === 'manager' || $user->role === 'cashier'; // Managers and cashiers can update
    }

    public function delete(User $user)
    {
        return false; // By default, no one can delete medication records
    }

    public function softDelete(User $user)
    {
        return $user->role === 'owner' || $user->role === 'manager' ; // Only owners and mangager can soft delete
    }
}