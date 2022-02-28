<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.articles.index', compact('categories'));
    }

    public function data()
    {
        $articles = Article::whenCategoryId(request()->category_id);

        return DataTables::of($articles)
                         ->addColumn('record_select', 'admin.articles.data_table.record_select')
                         ->editColumn('created_at', function (Article $article) {
                             return $article->created_at->format('Y-m-d');
                         })
                         ->addColumn('image', function (Article $article) {
                             return view('admin.articles.data_table.image', compact('article'));
                         })
                         ->addColumn('category', function (Article $article) {
                             return view('admin.articles.data_table.category', compact('article'));
                         })
                         ->addColumn('actions', 'admin.articles.data_table.actions')
                         ->rawColumns(['record_select', 'category', 'image', 'actions'])
                         ->toJson();

    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));

    }

    public function store(ArticleRequest $request)
    {
        $requestData = $request->validated();
        if ($request->image) {
            $request->image->store('public/uploads/articles/');
            $requestData['image'] = $request->image->hashName();
        }
        Article::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.articles.index');

    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));

    }

    public function update(ArticleRequest $request, Article $article)
    {
        $requestData = $request->validated();
        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/articles/' . $article->image);
            $request->image->store('public/uploads/articles/');
            $requestData['image'] = $request->image->hashName();
        }
        $article->update($requestData);

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.articles.index');

    }

    public function destroy(Article $article)
    {
        $this->delete($article);
        session()->flash('success', __('Deleted successfully'));
        return response(__('Deleted successfully'));

    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $article = Article::FindOrFail($recordId);
            $this->delete($article);

        }

        session()->flash('success', __('Deleted successfully'));
        return response(__('Deleted successfully'));

    }

    private function delete(Article $article)
    {
        if ($article->image) {
            Storage::disk('local')->delete('public/uploads/articles/' . $article->image);
        }
        $article->delete();

    }

}
