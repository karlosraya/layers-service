<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Parser;
use Illuminate\Support\Facades\DB;

class UserController extends Controller 
{
    public $successStatus = 200;

    public function login(){ 
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            if($user->enabled) {
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                return response()->json(['success' => $success], $this-> successStatus); 
            } else {
                return response()->json(['error'=>'Login failed! Account with username '. $user->username. ' is disabled. Please contact administrator.'], 401); 
            }
        } 
        else{ 
            return response()->json(['error'=>'Login failed! Please double check username and passowrd and try again.'], 401); 
        } 
    }

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'firstName' => 'required', 
            'lastName' => 'required', 
            'username' => 'required', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $input['enabled'] = true;
        $user = User::create($input); 

        return response()->json(['success'=>true], $this-> successStatus); 
    }

    public function auth() 
    { 
        $user = Auth::user(); 
        $user->authenticated = true;
        return response()->json($user, $this-> successStatus); 
    } 

    public function logout(Request $request) 
    { 
        $request->user()->token()->revoke();

        return response()->json(['success'=>true], $this-> successStatus); ; 
    } 

    public function getUsers() 
    { 
        $users = DB::table('users')->get();

        return response()->json($users, $this-> successStatus); 
    } 

    public function updateUser(Request $request) 
    { 
        $users = DB::table('users')->where('id', $request->id)->first();

        return response()->json($users, $this-> successStatus); 
    } 
}