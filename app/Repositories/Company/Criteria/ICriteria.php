<?php

namespace App\Repositories\Company\Criteria;

interface ICriteria
{
    public function withCriteria(... $criteria);
}