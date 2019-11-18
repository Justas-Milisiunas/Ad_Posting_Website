<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array|string|null message
 * @property mixed user_id
 * @property int ad_id
 * @property array|string|null comment_id
 * @method static pluck(string $string, string $string1)
 * @method static where(string $string, int $id)
 */
class Comment extends Model
{
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function replies() {
        return $this->hasMany('App\Comment');
    }
}
