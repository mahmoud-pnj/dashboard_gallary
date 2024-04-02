<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskState extends Model
{
    protected $dates = ['deleted_at'];

    protected $table='tasks_states';
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','progress_num_from','progress_num_to','color'];

}
