<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'content', 'published_at', 'published_by', 'media'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected $hidden = [];

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function published_by()
    {
        return $this->belongsTo('App\User');
    }
}
