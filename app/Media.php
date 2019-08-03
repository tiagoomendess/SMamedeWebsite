<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'path', 'thumbnail', 'tags'
    ];

    protected $casts = [];

    protected $hidden = [];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
