<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyVideo extends Model
{

    protected $fillable = [
        'company_id' ,'path'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
