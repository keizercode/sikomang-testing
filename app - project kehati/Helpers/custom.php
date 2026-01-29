<?php

use Illuminate\Support\Str;
use App\Models\Master\Menu;
use App\Models\Master\AccessMenu;
use App\Models\User;

if (!function_exists('taskLabel')) {
    /**
     * @param $val
     *
     * @return string
     */
    function taskLabel($val)
    {
        if ($val == 'store') {
            $task = 'save';
        } elseif ($val == 'save_permission') {
            $task = 'save group access';
        } elseif ($val == 'destroy') {
            $task = 'delete';
        } elseif ($val == 'batch') {
            $task = 'delete';
        } else {
            $task = $val;
        }

        return $task;
    }
}
if (!function_exists('logActivity')) {
    /**
     * @param $request
     * @param $note
     */
    function logActivity($request, $note)
    {
        $repository = app(\App\Models\Log::class);
        $data = [
            'module' => $request->route()->getAction('prefix'),
            'task' => taskLabel($request->route()->getActionMethod()),
            'user_id' => session('uid'),
            'ipaddress' => $request->getClientIp(),
            'useragent' => $request->header('User-Agent'),
            'note' => $note,
            'created_at' => \Carbon\Carbon::now()
        ];

        if (session('superuser') == false)
            $repository->create($data);
    }
}


if (!function_exists('trimId')) {
    /**
     * @param $val
     * @return array
     */
    function trimId($val)
    {
        $string = explode('+', $val);
        return $string;
    }
}


if (!function_exists('dateTime')) {
    /**
     * make secure id
     *
     * @param string|null $val
     *
     * @return string
     */
    function dateTime($date)
    {
        return date('d-m-Y H:i:s',strtotime(@$date));
    }
}

if (!function_exists('encode_id')) {
    /**
     * make secure id
     *
     * @param string|null $val
     *
     * @return string
     */
    function encode_id(?string $val = ''): string
    {
        $params = ['val' => $val];
        return rtrim(base64_encode(serialize($params)), "=");
    }
}

if (!function_exists('decode_id')) {
    /**
     * @param string|null $val
     * ${STATIC}
     *
     * @return      mixed|null
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     02/12/2023 4:28
     *
     */
    function decode_id(?string $val = ''): mixed
    {
        $secure = unserialize(base64_decode($val));
        return $secure ? $secure['val'] : null;
    }
}

if (!function_exists('permission')) {
    /**
     * @param        $access
     * @param        $key
     * @param string $method
     * @param bool   $view
     *
     * @return mixed
     */
    function permission($access, $key, string $method = 'menu', bool $view = false): mixed
    {   
        if (@session('group_id') != 1) {
            if ($method == 'module') {
                if (is_array($access)) {
                    $model = AccessMenu::where('module', 'LIKE', "{$key}%")->where('ms_group_id', session('group_id'))->first();
                    $query = count(array_intersect((array)$access, (array)$model->access));
                } else {
                    $query = AccessMenu::where($access, true)->where('module', 'LIKE', $key.'%')->where('ms_group_id', session('group_id'))->count();
                    if ($query > 0) {
                        return true;
                    } else {
                        return abort('401');
                    }
                }
            } else {
                $query = AccessMenu::where($access, true)->where('ms_menu_id', $key)->where('ms_group_id', session('group_id'))->count();
            }

            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

    }
}

if (!function_exists('access')) {
    /**
     * @param $access
     * @param $key
     *
     * @return bool
     */
    function access($access, $key)
    {
        if (session('group_alias') != 'administrator') {
            $query = AccessMenu::where($access, 1)->where('module', $key)->where('ms_group_id', session('group_id'))->count();
            if ($query > 0) {
                return true;
            } else if (session('group_alias') == 'administrator') {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}

if (!function_exists('activeMenuClass')) {
    /**
     * Helper to grab the application version.
     *
     * @return mixed
     */
    function activeMenuClass($route){
        // dd(request()->route()->getName());
        // if(request()->route()->getName() == $route){
        //     return true;
        // }else{
        //     return false;
        // }

        if (\Str::is($route, request()->route()->getName())) {
            return true;
        } else {
            return false;
        }
    }
    
}

if (!function_exists('renderMenu')) {
    
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function renderMenu()
    {
        
        $parent = Menu::where('status',true)->where('menu_type','sidebar')->where('parent_id',0)->orderBy('ordering','ASC')->get();
        $html = '';
        foreach ($parent as $a => $p1) {
            // echo $p1->MsMenuId.'<br>';
            $child2 = Menu::where('status',true)->where('menu_type','sidebar')->where('parent_id',$p1->MsMenuId)->orderBy('ordering','ASC')->get();
            $access1 = permission('is_read', $p1->MsMenuId, 'menu', true);

            $ch1 = count($child2) > 0 ? 'has-arrow' : '';
            $link1 = count($child2) > 0 ? '' : '';
            $collapse1 = count($child2) > 0 ? 'href="javascript: void(0);"' : '';
            $active = activeMenuClass($p1->module) ? 'mm-active' : '';
            // dd($p1->route);

            if ($access1) {
                $active1 = activeMenuClass($p1->module) ? 'mm-active' : '';

                $html .= '<li class="'.$active.'">
                <a '.$collapse1.' class="'.$ch1.' '.$active1.'" href="' . url($p1->url) . '">
                <i class="' . $p1->menu_icons . ' icon nav-icon"></i>
                <span>'.@$p1->title.'</span>';
                if (count($child2) > 0) {
                    $html .= '<span class="menu-arrow"></span>';
                    $html .= '</a>';
                    $html .= '<ul class="sub-menu" aria-expanded="false">';
                    foreach ($child2 as $b => $p2) {
                        $child3 = Menu::where('status',true)->where('menu_type','sidebar')->where('parent_id',$p2->MsMenuId)->get();
                        $access2 = permission('is_read', $p2->MsMenuId, 'menu', true);
                        $ch2 = count($child3) > 0 ? '' : '';
                        $collapse2 = count($child3) > 0 ? 'href="#subparent'.$b.'" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="parent'.$a.'"' : '';
                        $link2 = count($child3) > 0 ? '' : '';
                        if ($access2) {
                            $active2 = activeMenuClass($p2->module) ? 'mm-active' : '';
                            $html .= '<li class=" nav-item ' . $ch2 . ' '.$active2.'"><a '.$collapse2.' class=" '.$active2.'" href="' . url($p2->url) . '"><i class="' . $p2->menu_icons . ' icon nav-icon"></i> <span>' . @$p2->title.'<span>';
                            if (count($child3) > 0) {
                                $html .= '<span class="menu-arrow"></span>';
                                $html .= '</a>';
                                $html .= '<div class="collapse " id="subparent'.$b.'">';
                                $html .= '<ul class="sub-menu">';
                                foreach ($child3 as $p3) {
                                    $child4 = Menu::where('status',true)->where('menu_type','sidebar')->where('parent_id',$p3->MsMenuId)->get();
                                    $access3 = permission('is_read', $p3->MsMenuId, 'menu', true);
                                    $collapse3 = count($child4) > 0 ? 'data-fc-type="collapse"' : '';
                                    $ch3 = count($child4) > 0 ? '' : '';
                                    $link3 = count($child4) > 0 ? '' : '';
                                    if ($access3) {
                                        $active3 = activeMenuClass($p3->module) ? 'mm-active' : '';
                                        // $active3 = $active ? ' ' . null : null;
                                        $html .= '<li class=" nav-item ' . $ch3 .'"><a '.$collapse3.' class=" '.$active3.'" href="' . url($p3->url) . '"> <span>' . @$p3->title.'</span>';
                                        if (count($child4) > 0) {
                                            $html .= '<span class="menu-arrow"></span>';
                                            $html .= '</a>';
                                            $html .= '<ul class="sub-menu">';
                                            foreach ($child4 as $p4) {
                                                $html .= '<li class=" ' . null . '"><a class="" href="' . url($p4->url) . '"> <span>' . @$p4->title.'<span>';
                                            }
                                            $html .= '</ul>';
                                        } else {
                                            $html .= '</a>';
                                        }
                                        $html .= '</li>';
                                    }
                                }
                                $html .= '</ul>';
                                $html .= '</div>';
                            } else {
                                $html .= '</a>';
                            }
                            $html .= '</li>';
                        }
                    }
                    $html .= '</ul>';
                } else {
                    $html .= '</a>';
                }
                $html .= '</li>';
            }
        }
        return $html;
    }
}

if (!function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        include_files_in_folder($folder);
    }
}

if (!function_exists('include_files_in_folder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_files_in_folder($folder)
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}