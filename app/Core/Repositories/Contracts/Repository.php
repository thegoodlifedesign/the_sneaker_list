<?php namespace TGL\Core\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    public function getAll();

    public function getLatest();

    public function getAllPaginated($count);

    public function getById($id);

    public function getBySlug($slug);

    public function requireById($id);

    public function save(Model $model);

    public function delete(Model $model);
}