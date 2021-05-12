<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function propertyPicture(){
        return $this->hasMany(PropertyPicture::class);
    }
    public function savedProperty(){
        return $this->hasMany(SavedProperty::class);
    }
    public function flaggedProperty(){
        return $this->hasMany(FlaggedProperty::class);
    }
}
