<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');

    }

    public function data()
    {
        $users = User::where('id','!=',1)->select();

        return DataTables::of($users)
            ->addColumn('record_select', 'admin.users.data_table.record_select')
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.users.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create()
    {
        return view('admin.users.create');

    }

    public function store(UserRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        User::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.users.index');

    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));

    }

    public function update(UserRequest $request, User $user)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);
        $user->update($requestData);

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.users.index');

    }

    public function destroy(User $user)
    {
        $this->delete($user);
        session()->flash('success', __('Deleted successfully'));
        return response(__('Deleted successfully'));

    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::FindOrFail($recordId);
            $this->delete($user);

        }

        session()->flash('success', __('Deleted successfully'));
        return response(__('Deleted successfully'));

    }

    private function delete(User $user)
    {
        $user->delete();

    }

}
