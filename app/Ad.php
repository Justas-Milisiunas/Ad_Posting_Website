<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy()
 */
class Ad extends Model
{
    //
    public function user() {
        return $this->belongsTo('App\User');
    }
}
