<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user) {
        $roles = Role::all();
        return view('admin.users.profile', compact('user', 'roles'));
    }

    public function update(User $user) {
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file'],
            'password' => ['min:6', 'max:255', 'confirmed']
        ]);

        if (request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');
            $user->avatar = $inputs['avatar'];
        }

        $user->update($inputs);

        return back();
    }

    public function destroy(User $user, Request $request) {
        $this->authorize('delete', $user);
        $user->delete();
        $request->session()->flash('user-deleted-message', 'User was deleted');
        return redirect()->route('users.index');
    }

    public function attach(User $user) {
        $user->roles()->attach(request('role_id'));
        return back();
    }

    public function detach(User $user) {
        $user->roles()->detach(request('role_id'));
        return back();
    }
}