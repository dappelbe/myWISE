<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{

    use ResetsPasswords;

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
       // $this->_authEnabled = config('laravelusers.authEnabled');
       // $this->_rolesEnabled = config('laravelusers.rolesEnabled');
       // $this->_rolesMiddlware = config('laravelusers.rolesMiddlware');
       // $this->_rolesMiddleWareEnabled = config('laravelusers.rolesMiddlwareEnabled');

      //  if ($this->_authEnabled) {
      //      $this->middleware('auth');
      //  }

        if ($this->_rolesEnabled && $this->_rolesMiddleWareEnabled) {
            $this->middleware($this->_rolesMiddlware);
        }
    }



    public function create(Request $request) {

        $pk = $request->input('pk');
        $api_token = $request->input('api_token');

        $user = config('laravelusers.defaultUserModel')::create([
            'name'             => strip_tags($request->input('name')),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
            'randonum'         => $request->input('randonum'),
        ]);

        if ( !is_null( $api_token ) && !is_null( $pk ) ) {
            $authUser = User::find($pk);
            if ( !is_null($authUser)) {
                if ( $authUser->api_token == $api_token )  {
                    Auth::login($authUser);
                    $user->attachRole(3);
                    $user->save();
                    $this->resetPassword( $user );
                    return response()->json($user, 201);
                }
            }

        }

        return response()->json($user, 401);


    }


    public function create2(int $pk, string $api_token) {

        $myArray = array();


    //    $user = config('laravelusers.defaultUserModel')::create([
    //        'name'             => strip_tags($request->input('name')),
    //        'email'            => $request->input('email'),
    //        'password'         => Hash::make($request->input('password')),
    //        'randonum'         => $request->input('randonum'),
    //    ]);


            $user = config('laravelusers.defaultUserModel')::create([
                'name'             => strip_tags("frankie"),
                'email'            => "frankie@frankie.com",
                'password'         => Hash::make("password"),
                'randonum'         => "WISE-1234",
            ]);


        if ( !is_null( $api_token ) && !is_null( $pk ) ) {
            $authUser = User::find($pk);
            if ( !is_null($authUser)) {
                if ( $authUser->api_token == $api_token )  {

                    Auth::login($authUser);
                    $user->attachRole(3);
                    $user->save();
                    return response()->json($user, 201);
                }
            }

        }



    }
}
