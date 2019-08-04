<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor', 'description', 'amount', 'bank_desc', 'received_at', 'inserted_by'
    ];

    protected $casts = [
        'received_at' => 'datetime'
    ];

    protected $hidden = [];

    public function inserted_by()
    {
        return $this->belongsTo('App\User');
    }

    public function donation_intent()
    {
        return $this->hasOne('App\DonationIntent');
    }
}
