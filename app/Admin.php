<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use SoftDeletes;

    protected $fillable = [

        'name', 'user_name' ,'email', 'password',

    ];


    protected $hidden = [
        'password' , 'remember_token'
    ];


}
