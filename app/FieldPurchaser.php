<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldPurchaser extends Model
{
    protected $fillable = [
        'name', 'email'
    ];

    protected $casts = [];

    protected $hidden = [];

    public function purchases()
    {
        return $this->hasMany('App\FieldPurchase');
    }
}
