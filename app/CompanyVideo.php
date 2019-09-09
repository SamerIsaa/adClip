<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyVideo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id' ,'path'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
