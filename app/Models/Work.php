<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';

    protected $fillable =
    ['name','schedule_start','schedule_end','schedule_end',
     'start','end','status','member_id','member_name','memo','user_id','project_id'];

    use HasFactory;
}
