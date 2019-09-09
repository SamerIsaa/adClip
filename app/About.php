<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'facebook' , 'twitter' , 'instagram','about_ar' , 'about_en'
    ];

    public static function social()
    {
        return About::select('facebook' , 'twitter' , 'instagram')->first();
    }
}
