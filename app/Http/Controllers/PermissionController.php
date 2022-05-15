<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PermissionController extends Controller {
    public function index() {
        $permissions = Permission::withCount('roles')->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(Permission $permission) {
        return view('admin.permissions.create', compact('permission'));
    }

    public function store(Permission $permission) {

        $inputs = request()->validate([
            'name' => [
                'required',
                Rule::unique('permissions')->ignore($permission),
            ], 'max:255',
            'slug' => [
                'required',
                Rule::unique('permissions')->ignore($permission),
            ], 'max:255',
        ]);

        $permission->name = $inputs['name'];
        $permission->slug = $inputs['slug'];
        $permission->create($inputs);

        request()->session()->flash('permission-created-message', 'permission was created');
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission, Request $request) {
        $this->authorize('delete', $permission);
        $permission->delete();
        $request->session()->flash('permission-deleted-message', 'Permission was deleted');
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Permission $permission) {
        $this->authorize('update', $permission);

        $inputs = request()->validate([
            'name' => [
                'required',
                Rule::unique('permissions')->ignore($permission),
            ], 'max:255',
            'slug' => [
                'required',
                Rule::unique('permissions')->ignore($permission),
            ], 'max:255',
        ]);

        $permission->name = $inputs['name'];
        $permission->slug = $inputs['slug'];
        $permission->update();

        request()->session()->flash('permission-updated-message', 'Permission was updated');
        return redirect()->route('permissions.index');
    }
}