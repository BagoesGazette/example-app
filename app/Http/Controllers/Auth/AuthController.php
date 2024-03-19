<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        if (!Auth::check()) {
            return view('auth.login');
        }else{
            return redirect()->route('home');
        }
    }

    public function register(){
        if (!Auth::check()) {
            return view('auth.register');
        }else{
            return redirect()->route('home');
        }
    }

    public function loginPost(Request $request){
        $request->validate([
            'username'  => 'required|string',
            'password'  => 'required|string'
        ]);

        try{
            $username = $request->input('username');
            $password = $request->input('password');
            $check    = User::where('email', $username)->orWhere('phone', $username)->first();

            if ($check) {
                $credentials = [
                    'email'     => $check->email,
                    'password'  => $password
                ]; 

                if(Auth::attempt($credentials)) {
                    return redirect()->route('home');       
                }else{
                    $notification = array(
                        'error'   => 'Password salah',
                    );
        
                    return redirect()->route('login')->with($notification);
                }
            }else{
                $notification = array(
                    'error'   => 'Akun tidak ditemukan',
                );
    
                return redirect()->route('login')->with($notification);
            }


        } catch (\Throwable $e) {
            return redirect()->route('login')->with(['error' => 'Login gagal! ' . $e->getMessage()]);
        }
    }

    public function logout(){
        Auth::logout();

        return redirect('login');
    }
}
