<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'ms_group';
    protected $primaryKey = 'MsGroupId';
    protected $guarded = [];
}
