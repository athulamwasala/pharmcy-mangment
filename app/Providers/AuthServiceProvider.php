<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Medication;
use App\Models\Customer;
use App\Policies\MedicationPolicy;
use App\Policies\CustomerPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Medication::class => MedicationPolicy::class,
        Customer::class => CustomerPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
