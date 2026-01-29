<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\AccessMenu;
use App\Models\Master\Menu;
use App\Models\Master\Group;

class AksesController extends Controller
{
    protected $title = 'Hak Akses User';
    protected $template = 'modules.management.role.akses';
    protected $route = 'modules.management.role.akses';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getRoute($prefix = '*'): string
    {
        return $this->route.'.'.$prefix;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        permission('is_update', $this->getRoute(), false, 'module');
        $id = decode_id($request->group_id);
        // dd($id);
        $_read = [];
        if ($request->has('is_read')) {
            foreach ($request->input('is_read') as $val) {
                $_read[] = ['ms_menu_id' => $val];
            }
        }

        $_create = [];
        if ($request->has('is_create')) {
            foreach ($request->input('is_create') as $val) {
                $_create[] = ['ms_menu_id' => $val];
            }
        }

        $_update = [];
        if ($request->has('is_update')) {
            foreach ($request->input('is_update') as $val) {
                $_update[] = ['ms_menu_id' => $val];
            }
        }

        $_delete = [];
        if ($request->has('is_delete')) {
            foreach ($request->input('is_delete') as $val) {
                $_delete[] = ['ms_menu_id' => $val];
            }
        }

        $_download = [];
        if ($request->has('is_download')) {
            foreach ($request->input('is_download') as $val) {
                $_download[] = ['ms_menu_id' => $val];
            }
        }

        $merged = array_merge($_read, $_create, $_update, $_delete, $_download);
        $result = [];
        foreach ($merged as $key => $data) {
            $access = trimId($data['ms_menu_id']);
            $module = Menu::find($access[1]);
            if (isset($result[$access[1]])) {
                $result[$access[1]][$access[0]] = 1;
            } else {
                $result[$access[1]] = ['ms_menu_id' => intval($access[1]), $access[0] => 1, 'ms_group_id' => intval($id), 'module' => $module->module, 'menu_group' => $request->input('menu_group')];
            }
        }

        /**
         * Merge all privileges into json
         */
        $group = Group::find(intval($id));
        if ($merged) {
            $current = AccessMenu::where('menu_group',$request->input('menu_group'))->where('ms_group_id',intval($id))->get();
            $insert = null;
            if ($current->count() > 0) {
                $deletedRows = AccessMenu::where('menu_group',$request->input('menu_group'))->where('ms_group_id',intval($id))->delete();
                if ($deletedRows) {
                    foreach ($result as $val) {
                        $insert = AccessMenu::create($val);
                    }
                }
            } else {
                foreach ($result as $val) {
                    $insert = AccessMenu::create($val);
                }
            }

            if ($insert) {
                logActivity($request, __('Edit',['val' => strtolower(__('module.group.access.title',['val' => $group->name]))]));
                return redirect('management/role/')->with('message', __('Berhasil Update Data'))
                    ->with('type', 'success');
            } else {
                throw new GeneralException(__('Maaf Terjadi Kesalahan'));
            }
        } else {
            $current = AccessMenu::where('menu_group',$request->input('menu_group'))->where('ms_group_id', intval($id))->count();
            if ($current > 0) {
                AccessMenu::where('menu_group', $request->input('menu_group'))->where('ms_group_id', intval($id))->delete();
                logActivity($request, __('Delete',['val' => strtolower(__('Title',['val' => $group->name]))]));
                return redirect('management/role/')->with('message', __('Berhasil Update Data'))
                    ->with('type', 'success');
            } else {
                throw new GeneralException(__('Maaf Terjadi Kesalahan'));
            }
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
    public function edit($id)
    {
        $data['key']   = decode_id($id);
        $data['id']   = decode_id($id);
        $data['group']   = Group::where('MsGroupId',decode_id($id))->first();

        $data['breadcrumbs'] = [
            ['name' => 'Dashboard','url' => url('dashboard')],
            ['name' => 'Management & Akses Role'],
            ['name' => 'Data Role','url' => url('management/role/')],
            ['name' => 'Role '.$data['group']->name,'active' => true],
        ];
        
        $data['type'] = 'sidebar';
        $data['menu'] = $this->getMenu($data['key'], $data['type']);
        $data['title'] = $this->title.' '.$data['group']->name;
        $data['route'] = $this->route;
        return view($this->template.'.form',$data);
    }

    public function getMenuByParentPosition($id, $type, $active = [1])
    {
        return Menu::where('parent_id', '=', $id)
            ->where('menu_type', '=', $type)
            ->whereIn('status', $active)
            ->orderBy('ordering')
            ->get();
    }

    public function getParentByType($type)
    {
        return Menu::where('parent_id', '=', 0)
            ->where('menu_type', '=', $type)
            ->orderBy('ordering')
            ->get();
    }

    public function getMenuByParent($id, $active = [1])
    {
        return Menu::where('parent_id', '=', $id)
            ->whereIn('status', $active)
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function getActiveById($id)
    {
        return Menu::where('ms_menu_id', '=' , $id)
            ->where('status', '=' , true)
            ->first();
    }

    /**
     * Get all active menu by menu position
     *
     * @param $type
     * @return mixed
     */
    public function getActiveByPosition($type)
    {
        return Menu::where('menu_type', '=' , $type)
            ->where('status', '=' , true)
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @param $type
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getParentByTypeStatus($type)
    {
        return Menu::where('parent_id', '=', 0)
            ->where('menu_type', '=', $type)
            ->where('status','=',true)
            ->orderBy('ordering')
            ->get();
    }

    public function getMenu($id, $type)
    {
        $parent = $this->getMenuByParentPosition(0,$type);
        $_parent = [];
        foreach ($parent as $row) {
            $lev1 = $this->getMenuByParent($row->MsMenuId);
            $_lev1 = [];
            foreach ($lev1 as $l1) {
                $lev2 = $this->getMenuByParent($l1->MsMenuId);
                $_lev2 = [];
                foreach ($lev2 as $l2) {
                    $lev3 = $this->getMenuByParent($l2->MsMenuId);
                    $_lev3 = [];
                    foreach ($lev3 as $l3) {
                        $lev4 = $this->getMenuByParent($l3->MsMenuId);
                        $_lev4 = [];
                        foreach ($lev4 as $l4) {
                            $lev4Access = AccessMenu::where('ms_group_id', '=', $id)->where('ms_menu_id', '=', $l4->MsMenuId)->first();
                            $_lev4[] = [
                                'id' => $l4->MsMenuId,
                                'title' => $l4->title,
                                'ordering' => $l4->ordering,
                                'checked' => [
                                    "is_create" => $lev4Access ? $lev4Access->is_create : 0,
                                    "is_read" => $lev4Access ? $lev4Access->is_read : 0,
                                    "is_update" => $lev4Access ? $lev4Access->is_update : 0,
                                    "is_delete" => $lev4Access ? $lev4Access->is_delete : 0,
                                    "is_download" => $lev4Access ? $lev4Access->is_download : 0,
                                ]
                            ];
                        }
                        $lev3Access = AccessMenu::where('ms_group_id', '=', $id)->where('ms_menu_id', '=', $l3->MsMenuId)->first();
                        $_lev3[] = [
                            'id' => $l3->MsMenuId,
                            'title' => $l3->title . (!!$l3->meta_title?" ##Meta: ".  $l3->meta_title:""),
                            'ordering' => $l3->ordering,
                            'level4' => $_lev4,
                            'checked' => [
                                "is_create" => $lev3Access ? $lev3Access->is_create : 0,
                                "is_read" => $lev3Access ? $lev3Access->is_read : 0,
                                "is_update" => $lev3Access ? $lev3Access->is_update : 0,
                                "is_delete" => $lev3Access ? $lev3Access->is_delete : 0,
                                "is_download" => $lev3Access ? $lev3Access->is_download : 0,
                            ]
                        ];
                    }
                    $lev2Access = AccessMenu::where('ms_group_id', '=', $id)->where('ms_menu_id', '=', $l2->MsMenuId)->first();
                    $_lev2[] = [
                        'id' => $l2->MsMenuId,
                        'title' => $l2->title . " (".(!!$l2->meta_title?$l2->meta_title."@":""). "url:" . $l2->url.")",
                        'ordering' => $l2->ordering,
                        'level3' => $_lev3,
                        'checked' => [
                            "is_create" => $lev2Access ? $lev2Access->is_create : 0,
                            "is_read" => $lev2Access ? $lev2Access->is_read : 0,
                            "is_update" => $lev2Access ? $lev2Access->is_update : 0,
                            "is_delete" => $lev2Access ? $lev2Access->is_delete : 0,
                            "is_download" => $lev2Access ? $lev2Access->is_download : 0,
                        ]
                    ];
                }

                $lev1Access = AccessMenu::where('ms_group_id', '=', $id)->where('ms_menu_id', '=', $l1->MsMenuId)->first();
                $_lev1[] = [
                    'id' => $l1->MsMenuId,
                    'title' => $l1->title,
                    'ordering' => $l1->ordering,
                    'level2' => $_lev2,
                    'checked' => [
                        "is_create" => $lev1Access ? $lev1Access->is_create : 0,
                        "is_read" => $lev1Access ? $lev1Access->is_read : 0,
                        "is_update" => $lev1Access ? $lev1Access->is_update : 0,
                        "is_delete" => $lev1Access ? $lev1Access->is_delete : 0,
                        "is_download" => $lev1Access ? $lev1Access->is_download : 0,
                    ]
                ];
            }

            $parentAccess = AccessMenu::where('ms_group_id', '=', $id)->where('ms_menu_id', '=', $row->MsMenuId)->first();
            $_parent[] = [
                'id' => $row->MsMenuId,
                'title' => $row->title,
                'ordering' => $row->ordering,
                'level1' => $_lev1,
                'checked' => [
                    "is_create" => $parentAccess ? $parentAccess->is_create : 0,
                    "is_read" => $parentAccess ? $parentAccess->is_read : 0,
                    "is_update" => $parentAccess ? $parentAccess->is_update : 0,
                    "is_delete" => $parentAccess ? $parentAccess->is_delete : 0,
                    "is_download" => $parentAccess ? $parentAccess->is_download : 0,
                ]
            ];

        }

        return $_parent;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
