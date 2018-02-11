<?php

namespace App;

use Orchid\Platform\Core\Models\User as BaseUser;

class User extends BaseUser
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
        'avatar',
        'permissions',
        'first_name',
        'last_name',
        'city_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history(){
       return $this->hasMany(History::class);
    }

}
