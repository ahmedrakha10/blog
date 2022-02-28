<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::where(function ($q) use ($request) {
            if ($request->query) {
                $q->where('title', 'LIKE', '%' . request('query') . '%')
                  ->orWhere('description', 'LIKE', '%' . request('query') . '%');
            }

        })->latest()->paginate(6);
        $articles->appends(['query' => request('query')]);
        return view('front.articles', compact('articles'));
    }

    public function articleDetails($id)
    {
        $article = Article::findOrFail($id);
        return view('front.article_details', compact('article'));
    }

}
