<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    /**
     * The table associated with the model.
     *
     * 
     */
    protected $fillable = [
        'referee_id', 'referrer_id'
    ];

}
