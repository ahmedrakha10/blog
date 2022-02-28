<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.categories.index');

    }

    public function data()
    {
        $categories = Category::where('id','!=',1)->select();

        return DataTables::of($categories)
                         ->addColumn('record_select', 'admin.categories.data_table.record_select')
                         ->editColumn('created_at', function (Category $category) {
                             return $category->created_at->format('Y-m-d');
                         })
                         ->addColumn('actions', 'admin.categories.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }

    public function create()
    {
        return view('admin.categories.create');

    }

    public function store(CategoryRequest $request)
    {
        $requestData = $request->validated();
        Category::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.categories.index');

    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));

    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.categories.index');

    }

    public function destroy(Category $category)
    {
        $this->delete($category);
        session()->flash('success', __('Deleted successfully'));
        return response(__('Deleted successfully'));

    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $category = Category::FindOrFail($recordId);
            $this->delete($category);

        }

        session()->flash('success', __('Deleted successfully'));
        return response(__('Deleted successfully'));

    }

    private function delete(Category $category)
    {
        $category->delete();

    }

}
