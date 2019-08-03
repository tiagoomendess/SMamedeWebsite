<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationIntent extends Model
{
    protected $fillable = [
        'name', 'amount', 'email', 'donation_id'
    ];

    protected $casts = [];

    protected $hidden = [];

    public function donation()
    {
        return $this->belongsTo('App\Donation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isConfirmed()
    {
        return $this->donation ? true : false;
    }
}
