<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPicture extends Model
{
    //
    protected $guarded = [];
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
