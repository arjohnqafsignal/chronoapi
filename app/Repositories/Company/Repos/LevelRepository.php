<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\ILevel;
use App\Models\Company\Level;
use App\Repositories\Company\Repos\BaseRepository;

class LevelRepository extends BaseRepository implements ILevel
{
   public function model()
   {
       return Level::class;
   }

}