<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;





class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken("login-spa")->plainTextToken;
        return response()->json(['token'=>$token]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=> 'Logout sukses']);
    }
    public function register(Request $request){
       $validate =$request->validate([
        'email' => 'required|email',
        'name'=> 'required',
        'level'=>'required',
        'password'=>'required',
       ]);
       $userdata = [
       'email'=>$validate['email'],
       'name'=> $validate['name'],
       'level'=>$validate['level'],
       'password'=>Hash::make($validate['password'])
       ];
       $user = User::create($userdata);
       return response()->json(['message' => 'Registrasi sukses','data'=>$user]);

    }
}
