<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string link
 * @property  ad_id
 */
class Image extends Model
{
    public $timestamps = false;

    //
    public function ad() {
        return $this->belongsTo('App\Ad');
    }
}
