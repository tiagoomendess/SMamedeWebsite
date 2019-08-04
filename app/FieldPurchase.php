<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldPurchase extends Model
{
    protected $fillable = [
        'row', 'column', 'field_purchaser_id'
    ];

    protected $casts = [];

    protected $hidden = [];

    public function field_purchaser()
    {
        return $this->belongsTo('App\FieldPurchaser');
    }
}
