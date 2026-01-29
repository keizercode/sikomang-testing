<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    protected $table = 'ms_activity';
    protected $primaryKey = 'MsActivityId';

    protected $guarded = [];
}
