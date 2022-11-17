<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [ 
            'users' => User::with(array('roles' => function($query) {
                $query->get();
            }))
            ->get()
        ];
        return  response($response , 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = [ 
            'roles' => Role::all()  
        ];
        return  response($response, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            // 'role' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [ 
                'errors' => $validator->messages(),
            ];
            return  response($response, 201);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(isset($request->roles)){
            $user->assignRole($request->roles);
        }

        $response = [ 
            'user' => $user,
            'message' => "User created."
        ];
        return  response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        if (is_null($user)) {
            $response = [ 
                'message' => 'user not found',
            ];
            return  response($response, 404);
        }

        $roles = Role::all();

        $response = [ 
            'user' => $user,
            'user_has_roles' => $user->roles,
            'roles' => $roles
        ];
        return  response($response, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $user = User::where('id', $request->id)->first();
            if (is_null($user)) {
                abort(404);
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_image' => $request->profile_image
            ]);

            // delete all user roles
            DB::table('model_has_roles')->where('model_id', $request->id)->delete();

            if (isset($request->role)) {
                // reassign roles to user
                $roles = $request->input('role');
                $user->assignRole($roles);
            }

            $response = [ 
            'user' => $user,
            'message' => "User updated."
        ];
        return  response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if (is_null($user) and $id  == Auth::user()->id) {
            abort(404);
        }

        $user->delete();
    }
}
