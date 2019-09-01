<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
      'facebook' , 'twitter' , 'instagram','about_ar' , 'about_en'
    ];

    public static function social()
    {
        return About::select('facebook' , 'twitter' , 'instagram')->first();
    }
}
