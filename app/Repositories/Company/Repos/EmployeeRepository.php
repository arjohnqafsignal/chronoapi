<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\IEmployee;
use App\Models\Employee;
use App\Repositories\Company\Repos\BaseRepository;

use Illuminate\Support\Facades\DB;

class EmployeeRepository extends BaseRepository implements IEmployee
{
   public function model()
   {
       return Employee::class;
   }

   public function register($data)
   {
        DB::beginTransaction();

        try {
            $employee = $this->model->create($data);   
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return $employee;
   }

}