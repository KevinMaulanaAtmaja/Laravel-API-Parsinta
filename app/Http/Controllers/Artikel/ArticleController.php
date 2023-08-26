<?php

namespace App\Http\Controllers\Artikel;

use Illuminate\Support\Str;
use App\Models\Artikel\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikel = Article::paginate(2);
        return new ArticleCollection($artikel);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {

        $article = auth()->user()->articles()->create($this->articleStore());
        return $article;
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $artikel = new ArticleResource($article);
        return $artikel;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($this->articleStore());
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response(['message' => 'Artikel berhasil dihapus'], 200);
    }

    public function articleStore(){
        return [
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject')
        ];
    }
}
