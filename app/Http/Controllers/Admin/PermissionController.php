<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\StorePermissionRequest;

use Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN,'403 You have not permission');
        $title= "Admin";
        $subtitle="Permission";
        $permissions = Permission::paginate(15);
        return view('admin.permissions.index', compact('title','subtitle','permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN,'403 You have not permission');

        $title= "Admin";
        $subtitle="Add Permission";


        return view('admin.permissions.create',
        compact('title','subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $title= "Admin";
        $subtitle="Add Permission";
        Permission::create(
            $request->all());

        return redirect(route('permissions.index'))->withMessage("Permission created successfully")->withType('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show( Permission $permission)
    {

        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN,'403 You do not have  permission');

        $title= "Admin";
        $subtitle="Permission";


        return view('admin.permissions.show',compact('title','subtitle', 'permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN,'403 You have not permission');

        $title= "Admin";
        $subtitle="Edit Permission";
//$permission = Permission::find($id);

        return view('admin.permissions.edit',compact('title','subtitle', 'permission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN,'403 You have not permission');

        $permission->update($request->all());
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN,'403 You have not permission');

        $permission->delete($permission);
        return back()->withType('success')->withMessage('Moved to trash successfully');
//        return redirect(route('admin.permissions.index'))->withMessage("Permission deleted successfully")->withType('success');

    }
//    public function trashed(){
//        $title = "Permission trashed list";
//        $permissions = Permission::onlyTrashed()->paginate(10);
//        $subtitle = "Menagement Trashed permissions";
//        return view('admin.permissions.trashed', compact('title','subtitle', 'permissions' ));
//    }
//    public function restore($id)
//    {
//        Permission::withTrashed()->where('id',$id)->first()->restore();
//        return back()->withType('success')->withMessage('Restored Successfully ');
//    }
//    public function force($id){
//        Permission::withTrashed()->where('id',$id)->first()->forceDelete();
//        return back()->withType('success')->withMessage('Deleted successfully');
//    }
}
