<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

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
