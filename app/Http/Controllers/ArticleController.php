<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::with('category', 'tags')->paginate(),
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
            'title' => 'required|max:100|unique:articles,title',
            'body' => 'required|max:5000',
            'image' => [
                'image',
                Rule::dimensions()->maxWidth(2000)->maxHeight(2000)->minHeight(100)->minHeight(100),
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $article = Article::create($validated);

            if ($request->file('image')) {
                $path = $request->file('image')->store('articles');
                $article->update(['image_path' => $path]);
            }

            if ($request->tags) {
                $article->tags()->attach($request->tags);
            }
        });

        return redirect(route('articles.index'));
    }

    public function show(Article $article)
    {
        $article->load('category', 'tags');

        return view('article.show', [
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $article->load('category', 'tags');

        return view('article.edit', [
            'article' => $article,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'tags.*' => 'exists:tags,id',
            'title' => [
                'required',
                'max:100',
                Rule::unique('articles', 'title')->ignore($article->id),
            ],
            'body' => 'required|max:5000',
            'image' => [
                'image',
                Rule::dimensions()->maxWidth(2000)->maxHeight(2000)->minHeight(100)->minHeight(100),
            ],
        ]);

        DB::transaction(function () use ($request, $article, $validated) {
            if ($request->file('image')) {
                $path = $request->file('image')->store('articles');
                if ($article->image_path) {
                    Storage::delete($article->image_path);
                }
                $article->update(['image_path' => $path]);
            }
            $article->update($validated);
            $article->tags()->sync($request->tags);
        });

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
