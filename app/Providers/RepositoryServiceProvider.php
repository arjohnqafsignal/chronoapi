<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Company\Contracts\{
    IDepartment,
    IPosition,
    IBranch,
    ILevel,
    IBank,
    IEmployee,
};
use App\Repositories\Company\Repos\{
    DepartmentRepository,
    PositionRepository,
    BranchRepository,
    LevelRepository,
    BankRepository,
    EmployeeRepository,
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IDepartment::class, DepartmentRepository::class);
        $this->app->bind(IPosition::class, PositionRepository::class);
        $this->app->bind(IBranch::class, BranchRepository::class);
        $this->app->bind(ILevel::class, LevelRepository::class);
        $this->app->bind(IBank::class, BankRepository::class);
        $this->app->bind(IEmployee::class, EmployeeRepository::class);
    }
}
