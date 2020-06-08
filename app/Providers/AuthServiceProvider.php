<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Company\Department;
use App\Models\Company\Position;
use App\Models\Company\Branch;
use App\Models\Company\Level;
use App\Models\Company\Bank;
use App\Models\Employee;

use App\Policies\DepartmentPolicy;
use App\Policies\PositionPolicy;
use App\Policies\BranchPolicy;
use App\Policies\LevelPolicy;
use App\Policies\BankPolicy;
use App\Policies\EmployeePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Department::class => DepartmentPolicy::class,
        Position::class => PositionPolicy::class,
        Branch::class => BranchPolicy::class,
        Level::class => LevelPolicy::class,
        Bank::class => BankPolicy::class,
        Employee::class => EmployeePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
