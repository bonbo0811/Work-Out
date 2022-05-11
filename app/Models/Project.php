<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable =
    ['name','schedule_start','schedule_end','schedule_end',
     'start','end','memo','user_id'];

    use HasFactory;
}
