<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        //Ambil data user simpan di variabel $user
        $user = Auth::user();

        //Jika ada user ( user telah logged in)
        if($user){
        if($user->level=='admin'){
            return view()->intended('admin');
        }else if($user->level== 'user'){
            return view()->intended('user');
    }
}
    return view('login');
}


    public function proses_login(Request $request){
        //form validation
        $request->validate(
            [
            'email' => 'required',
            'password'=>'required'
            ]
            );
            //Ambil data dari $request, user dan poassword saja
            $credential = $request->only('email','password');
            //proses cek login di tabel users
            if(Auth::attempt($credential)){
                //jika login berhasil
                $user = Auth::user();
                if($user->level == 'admin'){
                    return redirect()->intended('admin');
            }else if($user->level == 'user'){
                return redirect()->intended('user');
            }
            return redirect()->intended('/');
     }
     //jika login gagal, arahkan ke halaman login
     //gunakan flash data untukmenampilkan error
     return redirect('login')
     ->withInput()
     ->withErrors(
        ['login_gagal'=>'user tidak terdaftar(email atau password salah)']
    );
 }
 public function logout(Request $request){
    //menghapus session log in
    $request->session()->flush();
    Auth::logout();
    return redirect('login');
}
public function register(){
    return view('register');
}
public function proses_register(Request $request){
 //form validation
 $validator = Validator::make($request->all(),
 [
  'name' =>'required',
  'email'=> 'required |email|unique:users',
  'password'=> 'required',
 ]
);

if($validator->fails()){
return redirect('register')
->withErrors($validator)
->withInput();
}

$request['level'] = 'user';
$request['password'] = Hash::make($request->password);


User::create($request->all());

//ke halaman login
return redirect()->route('login');



}
}
