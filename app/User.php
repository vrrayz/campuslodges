<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function kyc(){
        return $this->hasOne(Kyc::class);
    }
    public function lodge(){
        return $this->hasMany(Lodge::class);
    }
    public function profilePicture(){
        return $this->hasOne(ProfilePicture::class);
    }
    public function notification(){
        return $this->hasMany(Notifications::class);
    }
    public function savedLodge(){
        return $this->hasMany(SavedLodge::class);
    }
    public function property(){
        return $this->hasMany(Property::class);
    }
    public function savedProperty(){
        return $this->hasMany(SavedProperty::class);
    }
    public function flaggedLodge(){
        return $this->hasMany(FlaggedLodge::class);
    }
    public function flaggedProperty(){
        return $this->hasMany(FlaggedProperty::class);
    }
}
