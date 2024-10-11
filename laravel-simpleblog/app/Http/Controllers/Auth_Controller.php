<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth_Controller extends Controller{
    public function index(){
        return view('login',['title' => 'Login Page']);
    }
    public function auth(){
        $validasi = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($validasi)){
            request()->session()->regenerate();
            return redirect()->route('dashboard');
        }else {
            return redirect()->route('login');
        }
    }
    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('konten');
    }
}
