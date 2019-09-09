<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Catagory;
use App\City;
use App\Company;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\Compound;

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

    public function statistics()
    {
        $companiesCount = Company::all()->count();
        $catagoriesCount = Catagory::all()->count();
        $citiesCount = City::all()->count();
        $adminsCount = Admin::all()->count();

        $endedComp = Company::where('end_subscription' , '<=' , Carbon::now()->toDateTime())->get();

        return view('dashboard.index',
                    compact('companiesCount') ,
                    compact('catagoriesCount') )
                ->with('citiesCount' , $citiesCount)
                ->with('endedComp' , $endedComp)
                ->with('adminsCount' , $adminsCount);
    }
}
