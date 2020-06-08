<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\IBranch;
use App\Models\Company\Branch;
use App\Repositories\Company\Repos\BaseRepository;

class BranchRepository extends BaseRepository implements IBranch
{
   public function model()
   {
       return Branch::class;
   }

}