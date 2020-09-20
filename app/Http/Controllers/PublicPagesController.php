<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Home', [
            "articles" => Article::with(['author'])->get()
        ]);
    }
}