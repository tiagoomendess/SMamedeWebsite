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

    protected $table = 'field_purchasers';

    public function purchases()
    {
        return $this->hasMany('App\FieldPurchase');
    }
}
