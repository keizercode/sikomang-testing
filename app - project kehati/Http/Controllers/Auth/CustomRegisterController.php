<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class CustomRegisterController extends Controller
{
    public function index()
    {
        $data = [];
        return view('auth.register',$data);
    }

    public function post_register(Request $request)
    {

        // dd($request->all());
        try {
            Validator::make($request->all(), [
                'email'           => 'required|unique:users|email',
                'username'        => 'required|unique:users,username',
                'password'        => 'required|min:8|max:15|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/', //min 8 char, maks 15 char, min 1 symbol, min 1 uppercase, min 1 lowercase, 1 number
            ],[
                'password.min' => 'password Minimal 8 Karakter',
                'password.max' => 'password Maksimal 15 Karakter',
                'password.regex' => 'Format Kata Sandi harus mengandung minimal Huruf Besar, Huruf Kecil, Angka, Spesial Karakter',
            ])->validate();

            $user = new User;
            $user->email       = $request->email;
            $user->password    = Hash::make($request->password);
            $user->name        = $request->name;
            $user->username    = $request->username;
            $user->ms_group_id = 2;
            $user->save();


        } catch (Exception $e) {
            return redirect('register')->with([
                     'message' => $e->getMessage(),
                     'type'    => "error"
                ]);
        }
    }
}
