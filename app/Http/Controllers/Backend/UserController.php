<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    protected $validateRoles = [
        'name' => 'required|string|max:30',
        'email' => 'required|email|unique:users,email',
        'password' => 'sometimes',
        'role' => 'required',
        'image' => 'sometimes',
    ];

    public function index(Request $request)
    {
        $admins = User::query()->get();
        $roles = Role::query()->get();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('backend.admins.admins', compact('admins', 'roles'));
    }

    public function store(Request $request)
    {
        try {
            $data = $this->validate($request, $this->validateRoles);
            if ($request->hasFile('image')) {
                $ext = $request->file('image')->getClientOriginalExtension();
                $path = 'admins/';
                $name = time() . '.' . $ext;
                $request->file('image')->move(public_path($path), $name);
                $image = $path . $name;
            }
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'image' => $image ?? null,
            ]);
            $role = Role::where(['id' => $data['role']])->first();
            if ($role) {
                $user->assignRole($role->name);
            }

            $notification = createNotification('success', 'Created Successfully');

            return back()->with($notification);
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return back()->with($notification);
        }

    }

    public function update(Request $request, $id)
    {


        try {
            $fields = $request->validate([
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'sometimes',
                'role' => 'required',
                'image' => 'sometimes',
            ]);
            $admin = User::query()->where(['id' => $id])->first();
            if ($admin) {
                $admin->name = $fields['name'] ?? $admin->name;
                $admin->email = $fields['email'] ?? $admin->email;
                if (!is_null($fields['password'])) {
                    $admin->password = Hash::make($fields['password']);
                }

                if ($request->hasFile('image')) {
                    $ext = $request->file('image')->getClientOriginalExtension();
                    $path = 'admins/';
                    $name = time() . '.' . $ext;
                    $request->file('image')->move(public_path($path), $name);
                    $image = $path . $name;

                    $imagePath = public_path($admin->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $admin->image = $image ?? $admin->image;
                $role = Role::where(['id' => $fields['role']])->first();
                $admin->syncRoles([$role]);;
                $admin->save();
                $notification = createNotification('warning', 'Updated Successfully');
                return back()->with($notification);
            } else {
                $notification = createNotification('error', 'Admin Not Found');
                return back()->with($notification);
            }
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return back()->with($notification);
        }
    }

    public function destroy($id)
    {
        try {
            $admin = User::where(['id' => $id])->first();
            $notification = createNotification('success', 'Deleted Successfully');
            if ($admin) {

                if ($admin->image) {
                    $imagePath = public_path($admin->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $admin->delete();
                return back()->with($notification);
            } else {
                $notification = createNotification('error', 'Admin Not Found');
                return back()->with($notification);
            }
        } catch (\Throwable $th) {
            $notification = createNotification('error', $th->getMessage());
            return back()->with($notification);
        }
    }

}
