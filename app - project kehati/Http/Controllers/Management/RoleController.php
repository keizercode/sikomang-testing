<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Group;

class RoleController extends Controller
{
    protected $title = 'Hak Akses Pengguna';
    protected $template = 'modules.management.role';
    protected $route = 'modules.management.role';
    protected $url = 'management/role';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        permission('is_read', $this->route, 'module',true);
        $data['breadcrumbs'] = [
            ['name' => 'Dashboard','url' => url('dashboard')],
            ['name' => 'Management & Akses Role'],
            ['name' => 'Hak Akses Pengguna','active' => true],
        ];
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['url'] = $this->url;
        return view($this->template.'.index',$data);
    }

    public function grid(Request $request)
    {

        $data = Group::where('MsGroupId','!=',1)->orderBy('MsGroupId','DESC')->get();
        $_data = [];


        foreach ($data as $key => $row) {


            $action = '';
            $action .= '<div class="d-flex gap-1">';
            if((permission('is_create', $this->route.'.*','module',false)) || (permission('is_update', $this->route.'.*','module',false))){
                $action .= '<a href="'.url('/management/role/akses/'.encode_id($row->MsGroupId)).'/edit" data-toggle="tooltip" title="Edit Hak Akses Role" class="btn btn-sm btn-primary"><i class="mdi mdi-account-check text-white"></i></a>';
                $action .= '<a href="'.url('/management/role/update/'.encode_id($row->MsGroupId)).'" data-toggle="tooltip" title="Edit Data" class="btn btn-sm btn-success"><i class="mdi mdi-pencil text-white"></i></a>';
            }
            $action .= '</div>';
            
           $_data[] = [
            'no'                => $key+1,
            'id'                => encode_id($row->id),
            'name'              => @$row->name,
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
        //
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
            ['name' => 'Management & Akses Role'],
            ['name' => 'Hak Akses Pengguna','active' => true],
        ];
        $keyId = decode_id($id);
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['keyId'] = $id;
        $data['item'] = Group::find($keyId);
        return view($this->template.'.form',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
