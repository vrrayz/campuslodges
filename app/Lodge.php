<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lodge extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lodgePicture(){
        return $this->hasMany(LodgePicture::class);
    }
    public function lodgeRule(){
        return $this->hasMany(LodgeRule::class);
    }
    public function savedLodge(){
        return $this->hasMany(SavedLodge::class);
    }
    public function flaggedLodge(){
        return $this->hasMany(FlaggedLodge::class);
    }
}
