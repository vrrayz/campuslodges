<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlaggedLodge extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lodge(){
        return $this->belongsTo(Lodge::class);
    }
}
