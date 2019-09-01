<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/datatable',
        'catagories/datatable',
        'cities/datatable',
        'companies/datatable',
        'companies/datatable/ended',
        'company-ad/datatable',
        'contacts/datatable',
        'admin/delete',
        'catagory/delete',
        'city/delete',
        'company/delete',
        'company-ad/destroy',
        'company-ad/upload',
        'company-ad/delete',
    ];
}
