<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use App\Models\Article;
use Cog\Contracts\Love\Reactable\Models\Reactable;
use Cog\Contracts\Love\Reacterable\Models\Reacterable;
use Illuminate\Support\Facades\URL;

class ArticleRepository extends ReactableResourceRepository implements ArticleRepositoryInterface
{
    protected $model = Article::class;

    public function store($request, $user = null)
    {
        $user = $user ?? auth()->user();

        if (array_key_exists('id', $request)) {
            $article = $user->articles()->find($request['id']);

            if ($article) {
                $article->update($request);
                return true;
            } else {
                //TODO Populate error bag
                return false;
            }
        } else {
            $user->articles()->create($request);
            return true;
        }
    }

    public function others()
    {
        return $this->latest(20)->doesnthave('category');
    }

    //TODO Move in ResourceRepository - but generalize it there
    public function forManagerPage($userId = null, $actionRoutes = null)
    {
        $articles = $this->model::user($userId ?? auth()->user()->id)->paginate(5);

        //TODO Write resource routes class for storing these values
        $defaultRoutes = [
            "edit" => "articles.write",
            "delete" => "articles.delete",
        ];
        $navigation["routes"] = $actionRoutes ? array_merge($defaultRoutes, $actionRoutes) : $defaultRoutes;

        $navigation["userId"] = $userId;

        $articles->each(function ($value, $key) use ($navigation) {
            //TODO Write resource route generator helper in resource routes class
            $value["links"] = [
                "edit" => URL::route($navigation["routes"]["edit"], ["userId" => $navigation["userId"],"id" => $value->id]),
                "delete" => URL::route($navigation["routes"]["delete"], ["userId" => $navigation["userId"],"id" => $value->id]),
            ];
        });

        return $articles;
    }

    public function forEditor($id = null, $userId = null)
    {
        $article = $this->model::user($userId)->find($id);

        return $article;
    }
}
