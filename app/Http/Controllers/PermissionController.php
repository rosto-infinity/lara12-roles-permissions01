<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
 
class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [ 
            new Middleware(
                PermissionMiddleware::using('view permission'),
                 ['view']
            ),       
            new Middleware(
                PermissionMiddleware::using('create permission'),
                ['create', 'store']
            ),
            new Middleware(
                PermissionMiddleware::using('update permission'),
                only: ['update', 'edit']
            ),
            new Middleware(
                PermissionMiddleware::using('delete permission'),
                ['destroy']
            ),  
        ];
    }
// index method permission controller
    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $permissions = Permission::when($search,
         function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('role-permission.permission.index', ['permissions' => $permissions]);
    }
// create and store method permission controller
    public function create()
    {
       
        return view('role-permission.permission.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission Created Successfully');
    }
// edit and update method permission controller
    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission Updated Successfully');
    }
    // 2destroy method permission controller
    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status','Permission Deleted Successfully');
    }

}