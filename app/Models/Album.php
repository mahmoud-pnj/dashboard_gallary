<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Album extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = ['name'];
    public function pictures()
    {
        return $this->hasMany(AlbumPic::class);
    }

}
