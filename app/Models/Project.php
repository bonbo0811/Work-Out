<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable =
    ['name','schedule_start','schedule_end','schedule_end',
     'start','end','member1','member1_name','member2','member2_name',
     'member3','member3_name','memo','user_id'];

    use HasFactory;
}
