<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy()
 * @method static find(int $id)
 * @method static pluck(string $string, string $string1)
 * @property array|string|null name
 * @property mixed description
 * @property array|string|null price
 * @property  user_id
 * @property array|string|null expiration
 */
class Ad extends Model
{
    public $timestamps = false;

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
