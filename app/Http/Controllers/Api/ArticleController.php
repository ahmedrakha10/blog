<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function articles(Request $request)
    {
        $articles = Article::where(function ($q) use ($request) {
            if ($request->has('category_id')) {
                $q->where('category_id', $request->category_id);
            }
        })->with('category:id,name')->latest()->paginate(10);
        return api_response(ArticleResource::collection($articles), 'List of articles');
    }

    public function articleDetails($id)
    {
        $article = Article::with('category:id,name')->find($id);
        if ($article == null) {
            return api_response(null, 'No article');
        }
        $article->increment('views');
        return api_response(new ArticleResource($article), 'Article details');
    }
}
