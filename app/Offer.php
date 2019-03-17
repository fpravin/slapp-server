<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'expires_at', 'place_id'
    ];

    /**
     * Get the place that owns the offer.
     */
    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
