<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\IDepartment;
use App\Models\Company\Department;
use App\Repositories\Company\Repos\BaseRepository;

class DepartmentRepository extends BaseRepository implements IDepartment
{
   public function model()
   {
       return Department::class;
   }

}