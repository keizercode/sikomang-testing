<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;


class FrontController extends Controller
{
    function index() {
        $data['title'] = 'Beranda';
        // return redirect('login');
        return view('index',$data);
    }

    function lokasi($slug = null) {
        $data['title'] = 'Persebaran Lokasi Flora & Fauna';
        
        return view('lokasi',$data);
    }

    function flora($slug = null) {
        $data['title'] = 'Persebaran Flora';

        if(@$slug){
            return view('detail',$data);
        }else{
            return view('flora',$data);
        }
        
    }

    function fauna($slug = null) {
        $data['title'] = 'Persebaran Fauna';
        if(@$slug){
            return view('detail',$data);
        }else{
            return view('fauna',$data);
        }
    }

    function cagar($slug = null) {
        $data['title'] = 'Cagar Budaya';
        
        return view('cagarbudaya',$data);
    }

    function map($slug = null) {
        $data['title'] = 'Map';
        
        return view('map',$data);
    }

    function detail($slug = null) {
        $data['title'] = 'Detail';
        
        return view('detail',$data);
    }

    
}
