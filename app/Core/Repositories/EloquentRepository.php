<?php namespace TGL\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use TGL\Core\Repositories\Contracts\Repository;
use TGL\Core\Repositories\Exceptions\EntityNotFoundException;

abstract class EloquentRepository implements Repository
{
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getLatest()
    {
        return $this->model->latest()->limit(20)->get();
    }

    public function getAllPaginated($count)
    {
        return $this->model->latest()->paginate($count);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    public function requireById($id)
    {
        $model = $this->getById($id);
        if ( ! $model) {
            throw new EntityNotFoundException;
        }
        return $model;
    }

    public function save(Model $model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

}