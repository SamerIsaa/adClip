<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{


    protected $fillable = [
        'name_ar' , 'name_en' , 'description_ar' ,
        'description_en', 'city_id' , 'catagory_id',
        'subscription', 'end_subscription' , 'logo'
    ];


    /*
     *
     * this class belong to one city
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /*
     *
     * this class belong to one catagory
     *
     */
    public function Catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    /*
     *
     * this class have many video
     *
     */
    public function videos()
    {
        return $this->hasMany(CompanyVideo::class);
    }
}
