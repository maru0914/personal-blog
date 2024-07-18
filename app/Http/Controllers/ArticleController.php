<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::paginate(),
        ]);
    }

    public function show(Article $article)
    {
        return view('article.show', [
            'article' => $article,
        ]);
    }
}
