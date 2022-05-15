<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RoleController extends Controller {
    public function index() {

        $roles = Role::withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function destroy(Role $role, Request $request) {
        $this->authorize('delete', $role);
        $role->delete();
        $request->session()->flash('role-deleted-message', 'Role was deleted');
        return redirect()->route('roles.index');
    }

    public function update(Role $role) {
        $this->authorize('update', $role);

        $inputs = request()->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role),
            ], 'max:255',
            'slug' => [
                'required',
                Rule::unique('roles')->ignore($role),
            ], 'max:255',
        ]);

        $role->name = $inputs['name'];
        $role->slug = $inputs['slug'];
        $role->update();

        request()->session()->flash('role-updated-message', 'Role was updated');
        return redirect()->route('roles.index');
    }

    public function store(Role $role) {

        $inputs = request()->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role),
            ], 'max:255',
            'slug' => [
                'required',
                Rule::unique('roles')->ignore($role),
            ], 'max:255',
        ]);

        $role->name = $inputs['name'];
        $role->slug = $inputs['slug'];
        $role->create($inputs);

        request()->session()->flash('role-created-message', 'Role was created');
        return redirect()->route('roles.index');
    }

    public function create(Role $role) {
        return view('admin.roles.create', compact('role'));
    }

    public function permissionAttach(Role $role) {
        $role->permissions()->attach(request('permission_id'));
        return back();
    }

    public function permissionDetach(Role $role) {
        $role->permissions()->detach(request('permission_id'));
        return back();
    }
}