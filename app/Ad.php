<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy()
 * @method static find(int $id)
 * @method static pluck(string $string, string $string1)
 */
class Ad extends Model
{
    //
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
