<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Master\Group;

class UserController extends Controller
{
    protected $title = 'User';
    protected $template = 'modules.management.user';
    protected $route = 'modules.management.user';
    protected $url = 'management/user';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        permission('is_read', $this->route, 'module',true);
        
        $data['breadcrumbs'] = [
            ['name' => 'Dashboard','url' => url('dashboard')],
            ['name' => 'User & Hak Akses'],
            ['name' => 'Data User','active' => true],
        ];
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['url'] = $this->url;
        return view($this->template.'.index',$data);
    }

    public function grid(Request $request)
    {

        $data = User::with(['group'])->where('ms_group_id','!=',2)->where('id','!=',auth()->user()->id)->orderBy('id','DESC')->get();
        $_data = [];


        foreach ($data as $key => $row) {


            $action = '';
            $action .= '<div class="d-flex gap-1">';
            if((permission('is_create', $this->route.'.*','module',false)) || (permission('is_update', $this->route.'.*','module',false))){
                $action .= '<a href="'.url('management/user/update/'.encode_id($row->id)).'" data-toggle="tooltip" title="Edit Data" class="btn btn-sm btn-block btn-primary"><i class="mdi mdi-pencil text-white"></i></a>';
                if(session('group_id') == 1){
                    $action .= '<a href="#" data-href="'.url('management/user/forcelogin/'.encode_id($row->id)).'" data-toggle="tooltip" title="Force Login" class="forcelogin btn btn-sm btn-block btn-success"><i class="mdi mdi-account-check text-white"></i></a>';
                    $action .= '<a href="#" data-href="'.url('management/user/delete/'.encode_id($row->id)).'" data-toggle="tooltip" title="Edit Data" class="remove_data btn btn-sm btn-block btn-danger"><i class="mdi mdi-delete text-white"></i></a>';
                }
            }
            $action .= '</div>';
            
           $_data[] = [
            'no'                => $key+1,
            'id'                => encode_id($row->id),
            'name'              => @$row->name,
            'role'              => @$row->group->name,
            'username'          => @$row->username,
            'email'             => @$row->email,
            'created_at'        => dateTime(@$row->created_at),
            'action'            => @$action,
        ];

        }

        // return response()->json($_data);  // Return the data as a JSON response
        return response()->json($_data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $keyId = decode_id($request->secure_id);

            if(@$keyId){
                Validator::make($request->all(), [
                    'email'           => 'required|unique:users,email,'.$keyId.'|email',
                    'name'            => 'required|max:50',
                    'group'           => 'required',
                    'username'        => 'required|unique:users,username,'.$keyId,
                    'password'        => 'nullable|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/', //min 8 char, maks 15 char, min 1 symbol, min 1 uppercase, min 1 lowercase, 1 number
                ],[
                    'password.min' => 'password Minimal 8 Karakter',
                    'password.max' => 'password Maksimal 15 Karakter',
                    'password.regex' => 'Format Kata Sandi harus mengandung minimal Huruf Besar, Huruf Kecil, Angka, Spesial Karakter',
                ])->validate();

                $user = User::find($keyId);
                $user->email            = $request->email;
                $user->username         = $request->username;
                $user->ms_group_id      = decode_id($request->group);
                if(@$request->password){
                    $user->password = Hash::make($request->password);
                }
                $user->name     = $request->name;
                $user->save();
            }else{
                Validator::make($request->all(), [
                    'email'           => 'required|unique:users,email|email',
                    'name'            => 'required|max:50',
                    'group'           => 'required',
                    'username'        => 'required|unique:users,username',
                    'password'        => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/', //min 8 char, maks 15 char, min 1 symbol, min 1 uppercase, min 1 lowercase, 1 number
                ],[
                    'password.min' => 'password Minimal 8 Karakter',
                    'password.max' => 'password Maksimal 15 Karakter',
                    'password.regex' => 'Format Kata Sandi harus mengandung minimal Huruf Besar, Huruf Kecil, Angka, Spesial Karakter',
                ])->validate();

                $user = new User;
                $user->email            = $request->email;
                $user->username         = $request->username;
                $user->ms_group_id      = decode_id($request->group);
                if(@$request->password){
                    $user->password = Hash::make($request->password);
                }
                $user->name     = $request->name;
                $user->save();
            }

            return redirect()->back()->with([
                'message' => 'Berhasil update data',
                'type'    => 'success',
            ]);
            
        } catch (Exception $e) {
            return redirect()->back()->with([
                     'message' => $e->getMessage(),
                     'type'    => "error"
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id = null)
    {
        $data['breadcrumbs'] = [
            ['name' => 'Dashboard','url' => url('dashboard')],
            ['name' => 'User & Hak Akses'],
            ['name' => 'Data User','active' => true],
        ];
        $keyId = decode_id($id);
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['keyId'] = $id;
        $data['item'] = User::where('id',$keyId)->first();
        $data['group'] = Group::where('MsGroupId','!=',1)->get();
        return view($this->template.'.form',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        $keyId = decode_id($id);

        $user = User::where('id',$keyId)->delete();

        return response()->json(['success' => true,'message' => 'Berhasil update data','type' => 'success']);
    }

    public function forcelogin($id = null)
    {

        //dd($id);
    
        if (!$id) {
            return response()->json(['success' => false,'message' => 'Data Tidak Temukan','type' => 'error']);
        }

        $id = decode_id($id);
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false,'message' => 'Data Tidak Temukan','type' => 'error']);
        } else {

            if ($user->username && $user->password) {
                if (Auth::loginUsingId($id)) {
                    $session = [
                        'username'                  => $user->username,
                        'name'                      => $user->name,
                        'email'                     => $user->email,
                        'currYear'                  => date('Y'),
                        'group_id'                  => @$user->ms_group_id,
                        'group_alias'               => @$user->group->alias,
                        'group_name'                => @$user->group->name,
                    ];
                    // $this->repository->updateById($user->user_id,['last_login' => Carbon::now(), 'is_online' => session_id()]);
                    session($session);
                    // logActivity($request, __('strings.backend.logs.login_success',['name' => $user->username]));

                    return response()->json(['status' => true,'message' => 'Selamat datang kembali','type' => 'success']);
                }
                else {

                    return response()->json(['status' => false,'message' => 'Maaf Terjadi Kesalahan','type' => 'error']);
                }
            } else {
                return response()->json(['status' => false,'message' => 'Maaf Terjadi Kesalahan','type' => 'error']);
            }
        }
    }
}
