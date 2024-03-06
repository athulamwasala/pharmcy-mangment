<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
        return true; // All users can view customer records
    }

    public function create(User $user)
    {
        return false; // By default, no one can create customer records
    }

    public function update(User $user)
    { 
        return  $user->role === 'owner' ||  $user->role === 'manager' || $user->role === 'cashier'; //owner and  Managers and cashiers can update
    }

    public function delete(User $user)
    {
        return  $user->role === 'owner';
    }

    public function softDelete(User $user)
    {  
        return $user->role === 'owner' || $user->role === 'manager' ; // Only owners and manger can soft delete
    }
}
