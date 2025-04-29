<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view user', ['only' => ['index']]);
    //     $this->middleware('permission:create user', ['only' => ['create','store']]);
    //     $this->middleware('permission:update user', ['only' => ['update','edit']]);
    //     $this->middleware('permission:delete user', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $data['users'] = User::get();
        return view('backend.pages.user.index',$data);
    }

    public function create()
    {
        return view('backend.pages.user.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|string|min:8|max:20',
            // 'roles' => 'required'
        ]);

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'created_by' => auth()->user()->id,
                'created_at' => now(),
            ]);

        // $user->syncRoles($request->roles);

        toastr()->success('User has been Created successfully!');
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $data['user'] =  User::all();
        $data['roles'] = Role::get();
       return view('backend.pages.user.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
           
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'image' => $request->image,
            
        ];

        // if(!empty($request->password)){
        //     $data += [
        //         'password' => Hash::make($request->password),
        //     ];
        // }

        $user->update($data);
        // $user->syncRoles($request->roles);

        toastr()->success('User has been Created successfully!');
        return redirect()->route('user.index');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status','User Delete Successfully');
    }
}
