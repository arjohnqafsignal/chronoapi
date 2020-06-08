<?php

namespace App\Repositories\Company\Repos;
use App\Repositories\Company\Contracts\IBase;
use Illuminate\Support\Arr;
use App\Repositories\Company\Criteria\ICriteria;
use App\Exceptions\ModelNotDefined;
abstract class BaseRepository implements IBase, ICriteria
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    public function all()
    {
        return $this->model->get();
    }

    public function allMine()
    {
        return $this->model->where('user_id', auth()->user()->id)->get();
    }

    public function find($id)
    {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    public function findWhere($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    public function findWhereFirst($column, $value)
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    public function paginate($perPage=10)
    {
        return $this->model->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->find($id);
        $record->delete($id);
    }

    public function withCriteria(... $criteria)
    {
        $criteria = Arr::flatten($criteria);

        foreach($criteria as $criterion)
        {
            $this->model = $criterion->apply($this->model);
        }
        
        return $this;
    }

    protected function getModelClass()
    {
        if(!method_exists($this, 'model'))
        {
            throw new ModelNotDefined();
        }
        return app()->make($this->model());
    }
}