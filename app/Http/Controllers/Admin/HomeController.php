<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::count();
        $categories = Category::count();
        $articles = Article::count();
        return view('admin.home', compact('users', 'categories', 'articles'));

    }

}
