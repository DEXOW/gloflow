<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UsersManagerController extends Controller
{
    /**
     * Show the application User Management Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users_manager', compact('users'), compact('roles'));
    }

    public function add_user(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'address' => 'required',
            'phone_number' => 'required',
            'role_id' => 'required',
        ]);

        $name = $validated['name'];
        $email = $validated['email'];
        $password = bcrypt($validated['password']);
        $address = $validated['address'];
        $phone_number = $validated['phone_number'];
        $role_id = $validated['role_id'];

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number,
            'address' => $address,
            'role_id' => $role_id,
        ]);

        return Redirect::back()->with('success', 'User added successfully.');
    }

    public function delete_user($id) : RedirectResponse
    {   
        User::where('id', $id)->delete();
        
        return Redirect::back()->with('success', 'User deleted successfully.');
    }

    public function update_user(Request $request, $id) : RedirectResponse
    {

        $name = $request->input('name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');
        $role_id = $request->input('role_id');

        $user = User::find($id);

        if ($user->name != $name) {
            $user->name = $name;
        }
        if ($user->email != $email) {
            $user->email = $email;
        }
        if ($user->phone_number != $phone_number) {
            $user->phone_number = $phone_number;
        }
        if ($user->address != $address) {
            $user->address = $address;
        }
        if ($user->role_id != $role_id) {
            $user->role_id = $role_id;
        }

        $user->update();

        return Redirect::back()->with('success', 'User updated successfully.');
    }

    public function activate_user($id) : RedirectResponse
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->update();

        return Redirect::back()->with('success', 'User activated successfully.');
    }

    public function deactivate_user($id) : RedirectResponse
    {
        $user = User::find($id);
        $user->status = 'inactive';
        $user->update();

        return Redirect::back()->with('success', 'User deactivated successfully.');
    }
}
