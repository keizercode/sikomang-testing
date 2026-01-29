<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Sektor;
use App\Models\Master\SubSektor;

class AjaxController extends Controller
{
    function getSubsektor(Request $request) {
        $_data = [];
        if(@$request->id){
            $data = SubSektor::where('ms_sektor_id',decode_id($request->id))->get();
            foreach($data as $k => $val){
                $_data[$k]['id'] = encode_id($val->MsSubSektorId);
                $_data[$k]['name'] = $val->nama;
            }
        }
        return response()->json(['status' => true, 'data' => $_data]);        
    }
}
