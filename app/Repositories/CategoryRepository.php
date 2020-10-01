<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends ResourceRepository
{
    protected $model = Category::class;

    public function important()
    {
        return $this->model::limit(10)->has('articles')->with('articles');
    }

    public function latest(int $limit = 0)
    {
        return $this->model::orderBy('id', 'desc');
    }
}