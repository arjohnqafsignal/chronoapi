<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\IBank;
use App\Models\Company\Bank;
use App\Repositories\Company\Repos\BaseRepository;

class BankRepository extends BaseRepository implements IBank
{
   public function model()
   {
       return Bank::class;
   }

}