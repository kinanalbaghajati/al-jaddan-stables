<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete,admin', ['only' => ['index','store']]);
//        $this->middleware('permission:role-create,admin', ['only' => ['create','store']]);
//        $this->middleware('permission:role-edit,admin', ['only' => ['edit','update']]);
//        $this->middleware('permission:role-delete,admin', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        $title = 'Delete Role!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('backend.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {


            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);
            $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
            $role->syncPermissions($request->input('permission'));
            $notification = createNotification('success', 'Created Successfully');
            return redirect()->route('role.index')
                ->with($notification);
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('backend.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('backend.roles.edit', compact('role', 'permission', 'rolePermissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {


            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            $notification = createNotification('warning', 'Role updated successfully');
        return redirect()->route('role.index')
            ->with($notification);
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        $notification = createNotification('success', 'Deleted Successfully');
        return redirect()->route('role.index')
            ->with($notification);
    }
}
