<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LodgePicture extends Model
{
    //
    protected $guarded = [];

    public function lodge(){
        return $this->belongsTo(Lodge::class);
    }
}
