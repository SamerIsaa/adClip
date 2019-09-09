<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    use SoftDeletes;


    protected $fillable  =  ['name_ar' , 'name_en'];


    /*
     *
     * this class has Many Companies
     *
     */
    public function company()
    {
        return $this->hasMany(Company::class);
    }

}
