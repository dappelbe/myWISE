<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    private $_authEnabled;
    private $_rolesEnabled;
    private $_rolesMiddlware;
    private $_rolesMiddleWareEnabled;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_authEnabled = config('laravelusers.authEnabled');
        $this->_rolesEnabled = config('laravelusers.rolesEnabled');
        $this->_rolesMiddlware = config('laravelusers.rolesMiddlware');
        $this->_rolesMiddleWareEnabled = config('laravelusers.rolesMiddlwareEnabled');

        if ($this->_authEnabled) {
            $this->middleware('auth');
        }

        if ($this->_rolesEnabled && $this->_rolesMiddleWareEnabled) {
            $this->middleware($this->_rolesMiddlware);
        }
    }



    public function create(Request $request) {

        $user = config('laravelusers.defaultUserModel')::create([
            'name'             => strip_tags($request->input('name')),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
            'randonum'         => $request->input('randonum'),
        ]);

        if ( !is_null($request->input('api_token' ) ) && !is_null($request->input('pk' ) ) ) {

            $authUser = User::find($request->input('pk' ));
            if ( !is_null($authUser)) {
                if ( $authUser->api_key == $request->input('api_token' ) )  {
                    if ($this->_rolesEnabled) {
                        $user->attachRole($request->input('role'));
                        $user->save();
                    }
                    return response()->json($user, 201);
                }
            }

        }

        return response()->json($user, 401);


    }
}
