<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UsersManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application User Management Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('user_manager', compact('users'), compact('roles'));
    }

    public function add_user(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $role_id = $request->input('role_id');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number,
            'address' => $address,
            'role_id' => $role_id,
        ]);

        return redirect()->route('dashboard.users_manager')->with(
            'success',
            'User added successfully.'
        );
    }

    public function delete_user($id)
    {   
        User::where('id', $id)->delete();
        
        return redirect()->route('dashboard.users_manager')->with(
            'success',
            'User deleted successfully.'
        );
    }

    public function update_user(Request $request, $id)
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

        return redirect()->route('dashboard.users_manager')->with(
            'success',
            'User updated successfully.'
        );
    }

    public function activate_user($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->update();

        return redirect()->route('dashboard.users_manager')->with(
            'success',
            'User activated successfully.'
        );
    }

    public function deactivate_user($id)
    {
        $user = User::find($id);
        $user->status = 'inactive';
        $user->update();

        return redirect()->route('dashboard.users_manager')->with(
            'success',
            'User deactivated successfully.'
        );
    }
}
