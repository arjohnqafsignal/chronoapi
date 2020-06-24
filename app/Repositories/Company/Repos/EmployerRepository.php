<?php

namespace App\Repositories\Company\Repos;
use App\Models\Employer;
use App\Repositories\Company\Repos\BaseRepository;
use App\Repositories\Company\Contracts\IEmployer;

class EmployerRepository extends BaseRepository implements IEmployer
{
   public function model()
   {
       return Employer::class;
   }

}