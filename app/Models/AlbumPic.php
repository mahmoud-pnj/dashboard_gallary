<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AlbumPic extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $table = 'albums_pic';

    protected $fillable = [
        'album_id',
        'name',
        'picture',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
