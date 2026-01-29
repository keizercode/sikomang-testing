<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'ms_menu';
    protected $primaryKey = 'MsMenuId';
    protected $guarded = [];
    
    public function submenu()
    {
        return $this->hasMany(Menu::class,'parent_id','id');
    }

    public static function coreMenus($type, array $status = [1]): mixed
    {
        return Menu::where('parent_id', '=', 0)
            ->where('menu_type', '=', $type)
            ->whereIn('status', $status);
    }

    public static function coreMenusByParent($id, array $status = [1]): mixed
    {
        return Menu::where('parent_id', '=', $id)
            ->whereIn('status', $status);
    }

    public static function getMenuByParentPosition($id, $type, array $active = [1], int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('parent_id', '=', $id)
            ->where('menu_type', '=', $type)
            ->whereIn('status', $active)
            ->union(Menu::coreMenus($type, $active))
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 12:53
     *
     * @param          $type
     * @param int|null $year
     *
     * @return      mixed
     */
    public static function getParentByType($type, int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('parent_id', '=', 0)
            ->where('menu_type', '=', $type)
            ->union(Menu::coreMenus($type))
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 18:07
     *
     * @param          $type
     * @param int|null $year
     *
     * @return      mixed
     */
    public static function getMenuByYear($type, int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('parent_id', '=', 0)
            ->where('menu_type', '=', $type)
            ->where('status', '=', true)
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 12:54
     *
     * @param          $type
     * @param int|null $year
     *
     * @return      mixed
     */
    public static function getParentByTypeStatus($type, int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('parent_id', '=', 0)
            ->where('menu_type', '=', $type)
            ->where('status', '=', true)
            ->union(Menu::coreMenus($type))
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 12:54
     *
     * @param          $id
     * @param array    $active
     * @param int|null $year
     *
     * @return      mixed
     */
    public static function getMenuByParent($id, array $active = [1], int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('parent_id', '=', $id)
            ->union(Menu::coreMenusByParent($id, $active))
            ->whereIn('status', $active)
            ->orderBy('ordering')
            ->get();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 14:54
     *
     * @param int $year
     *
     * @return      mixed
     */
    public static function countMenuByYear(int $year): mixed
    {
        $model = Menu::where('status', '=', true);
        return $model->count();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 12:55
     *
     * @param          $id
     * @param int|null $year
     *
     * @return      mixed
     */
    public static function getActiveById($id, int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('id', '=', $id)
            ->where('status', '=', true)
            ->first();
    }

    /**
     * @author      alex.gz <amqit.consultant@gmail.com>
     * @created     08/12/2023 12:55
     *
     * @param          $type
     * @param int|null $year
     *
     * @return      mixed
     */
    public static function getActiveByPosition($type, int $year = null): mixed
    {
        if ($year) {
            $currYear = $year;
        } else {
            $currYear = date('Y');
        }

        return Menu::where('menu_type', '=', $type)
            ->where('status', '=', true)
            ->union(Menu::coreMenus($type))
            ->orderBy('ordering')
            ->get();
    }
}
