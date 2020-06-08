<?php

namespace App\Repositories\Company\Contracts;

interface IBase
{
    public function all();
    public function allMine();
    public function find($id);
    public function findWhere($column, $value);
    public function findWhereFirst($column, $value);
    public function paginate($perPage=10);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}