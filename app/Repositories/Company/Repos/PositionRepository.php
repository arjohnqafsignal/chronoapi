<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\IPosition;
use App\Models\Company\Position;
use App\Repositories\Company\Repos\BaseRepository;

class PositionRepository extends BaseRepository implements IPosition
{
   public function model()
   {
       return Position::class;
   }

}