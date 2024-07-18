<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'tags.*' => 'exists:tags,id',
            'title' => 'required|max:20|unique:articles,title',
            'body' => 'required|max:5000',
            'image' => [
                'required',
                'image',
                Rule::dimensions()->maxWidth(2000)->maxHeight(2000)->minHeight(100)->minHeight(100),
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $article = Article::create($validated);
            $request->file('image')->store('articles');

            if ($request->tags) {
                $article->tags()->attach($request->tags);
            }
        });

        return redirect(route('articles.index'));
    }

    public function show(Article $article)
    {
        return view('article.show', [
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('article.index');
    }
}
