<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\City;
use App\Company;
use http\Env\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function indexSite()
    {
        $companies = Company::where('endSubscription' , '0')->latest()->take(12)->get();
        $cities = City::all();
        $catagories = Catagory::all();

        return view('site.index', compact('companies'), compact('cities'))
                    ->with('catagories', $catagories);
    }

    public function changeLang($locale)
    {
        session()->put('locale' , $locale);
        return redirect()->back();

    }
}
