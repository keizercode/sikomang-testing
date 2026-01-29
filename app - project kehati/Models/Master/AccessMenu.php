<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessMenu extends Model
{
    use HasFactory;
    protected $table = 'ms_access_menu';
    protected $primaryKey = 'MsAccessMenuId';
    protected $guarded = [];
}
