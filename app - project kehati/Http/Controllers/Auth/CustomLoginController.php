<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class CustomLoginController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('dashboard');
        }
        $data['title'] = 'Login';
        return view('auth.login',$data);
    }

    public function forgotpass()
    {
        if(Auth::check()){
            return redirect('dashboard');
        }
        $data['title'] = 'Lupa Kata Sandi';
        return view('auth.forgotpass',$data);
    }
    function post_forgotpass(Request $request) {
        Validator::make($request->all(), [
            'username'     => 'required',
            'password'      => 'required',
        ])->validate();

        $user = User::where('ms_group_id','!=',1)->where('username',$request->username)->first();
        if(@$user){
            @$user->password = Hash::make($request->password);
            @$user->save();

            return redirect('/login')->with([
                        'message' => trans('Kata Sandi Berhasil Diupdate Silahkan Login!'),
                        'type'    => "success"
                ]);
                
        }else{
            return redirect()->back()
                      ->withInput()
                      ->with([
                         'message' => trans('Username tidak ditemukan'),
                         'type'    => "error"
                    ]);   
        }
    }
    public function post_login(Request $request)
    {
        Validator::make($request->all(), [
            'username'     => 'required',
            'password'      => 'required',
        ])->validate();

        $credentials  = array('username' => $request->username, 'password' => $request->password);

        $user = User::where('username', $credentials['username'])->first();
        // dd($user);
        if(@$user){
            if ($user && Hash::check($credentials['password'], $user->password)) {
                // dd($user->group);
                    Auth::attempt(['username' => $request->username, 'password' => $request->password]); 

                    $session = [
                        'username'                  => $user->username,
                        'name'                      => $user->name,
                        'email'                     => $user->email,
                        'currYear'                  => date('Y'),
                        'group_id'                  => @$user->ms_group_id,
                        'group_alias'               => @$user->group->alias,
                        'group_name'                => @$user->group->name,
                    ];
                    session($session);

                    return redirect('dashboard')->with([
                         'message' => trans('Selamat datang kembali'),
                         'type'    => "success"
                    ]);
                
            }else{
                return redirect('/login')
                      ->withInput()
                      ->with([
                         'message' => trans('Akun anda tidak ditemukan'),
                         'type'    => "error"
                    ]);
            }
        }else{
            return redirect('/login')
                      ->withInput()
                      ->with([
                         'message' => trans('Akun anda tidak ditemukan'),
                         'type'    => "error"
                    ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')
                  ->withInput()
                  ->with([
                     'message' => trans('Berhasil Keluar'),
                     'type'    => "success"
                ]);

    }
}
