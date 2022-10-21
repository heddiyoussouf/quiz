<?php

namespace Modules\Auth\Entities;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = ["name","email","password","type","email_verified_at","expired_at"];
    protected $casts=[
        "created_at"=>"datetime:Y-m-d",
        "updated_at"=>"datetime:Y-M-d",
        "expired_at"=>"datetime:Y-M-d"
    ];
    protected $hidden = ['password','remember_token','email_verified_at','type','updated_at','created_at'];
    protected $appends=[];
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\UserFactory::new();
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
