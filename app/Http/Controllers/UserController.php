<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
class UserController extends Controller implements HasMiddleware
{
   
   
    public static function middleware()
    {
        return [ 
    new Middleware(
        PermissionMiddleware::using('view user'),
         ['view']
    ),
    new Middleware(
        PermissionMiddleware::using('delete user'),
         ['destroy']
    ),
    new Middleware(
        PermissionMiddleware::using('update user'),
        ['update', 'edit']
    ),
    new Middleware(
        PermissionMiddleware::using('create user'),
        ['create', 'store']
    ),
];

}
    
    // 7-index method
    public function index(Request $request)
    {
        // 8get all users
        // $users = User::get();
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('email', 'like', "%{$search}%");
        })->get();
        return view('role-permission.user.index', ['users' => $users]);
    }
// create and store method
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);
      // create user
        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
// sync roles
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User created successfully with roles');
    }
// edit and update method
    public function edit(User $user)
    {
        // get all roles
        // get user roles
        // return view with user, roles and userRoles
        
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);
// update user
// sync roles
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User Updated Successfully with roles');
    }
// delete method
    public function destroy($userId)
    {
        // find user by id and delete
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status','User Delete Successfully');
    }
}