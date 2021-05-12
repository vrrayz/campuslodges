<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedLodge extends Model
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
