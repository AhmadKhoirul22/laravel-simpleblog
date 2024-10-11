<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class User_Controller extends Controller
{
    public function index(){
        $user = User::all();
        return view('user', [
            'title' => 'User',
            'user' => $user
        ]);
    }
    public function store(Request $request){
        $validasi = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        if($validasi == false){
            return redirect()->back()->withErrors($validasi)->withInput();
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect()->route('user')->with('notifikasi', 'User berhasil ditambahkan.');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user')->with('notifikasi', 'User berhasil dihapus.');
    }
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, lanjutkan dengan update
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        // Cek apakah password diisi, jika diisi maka update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('user')->with('notifikasi', 'User berhasil diupdate.');
    }
}
