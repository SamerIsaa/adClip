<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\City;
use App\Company;
use App\Http\Requests\CompaniesRequest;
use Carbon\Carbon;
use DemeterChain\C;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::all();
        $cities = City::all();
        return view('dashboard.companies.create')
            ->with('cities', $cities)
            ->with('catagories', $catagories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesRequest $request)
    {
        $data = $request->all();

        // convert from dateTime format to carabon and add number of days to
        // create a new timestamp format
        $data['subscription'] = Carbon::createFromTimeString($data['subscription']);
        $data['end_subscription'] = Carbon::createFromTimeString($data['subscription'])->addDays($data['days']);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $name = $logo->getClientOriginalName();
            $path = 'logos/';
            $full_path = $path . $name;
            $logo->move($path, $name);
            $data['logo'] = $full_path;
        }


        $company = Company::create($data);

        if ($company) {
            session()->flash('success', 'لقد تمت عملية الإضافة بنجاح');
            return redirect()->back();
        } else {
            session()->flash('error', 'لقد حدث خطأ ما اثناء عملية الإضافة');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $company = Company::with('city')
                ->with('catagory')->findOrFail($id);
            return view('dashboard.companies.show', compact('company'));

        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $catagories = Catagory::all();
            $cities = City::all();
            $company = Company::findOrFail($id);
            return view('dashboard.companies.edit', compact('company'))
                ->with('cities', $cities)
                ->with('catagories', $catagories);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        try {
            $company = Company::findOrFail($id);
            $data['end_subscription'] = Carbon::createFromTimeString($company->end_subscription)->addDays($data['extra_days']);
            $company->update($data);

            session()->flash('success', 'تمت تعديل التصنيف بنجاح');
            return redirect()->back();

        } catch (\Exception $exception) {
            session()->flash('error', 'لقد حدث خطأ ما');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Company::destroy($request['id']);
            return "1";
        } catch (\Exception $e) {
            return "2";
        }
    }


    public function datatable()
    {
        $length = Input::get('length');
        $start = Input::get('start');
        $search = Input::get('search');
        $search = $search['value'];

        $orderCol = Input::get(('order'));
        $orderDir = Input::get(('order'));

        $orderCol = $orderCol[0]['column'];
        $orderDir = $orderDir[0]['dir'];

        $company = Company::query();
        $company->where('endSubscription', '0');

        if ($orderCol != null) {
            if ($orderCol == 1) {
                $company->orderBy('name_ar', $orderDir);
            } elseif ($orderCol == 2) {
                $company->orderBy('name_en', $orderDir);
            }
        }

        if ($search != null) {
            $company = $company->orWhereHas('city', function ($query) use ($search) {
                $query->where('name_ar', 'like', '%' . $search . '%')
                    ->orWhere('name_en', 'like', '%' . $search . '%');
            });
            $company = $company->orWhereHas('catagory', function ($query) use ($search) {
                $query->where('name_ar', 'like', '%' . $search . '%')
                    ->orWhere('name_en', 'like', '%' . $search . '%');
            });
            $company = $company->orWhere('name_ar', 'like', '%' . $search . '%')
                ->orWhere('name_ar', 'like', '%' . $search . '%')
                ->orWhere('description_ar', 'like', '%' . $search . '%')
                ->orWhere('description_en', 'like', '%' . $search . '%');
        }

        $company2['iTotalRecords'] = $company->count();
        $company2['iTotalDisplayRecords'] = $company->count();
        $company2['sEcho'] = 0;
        $company2['sColumns'] = '';

        $company2['data'] = $company->with('city')->with('catagory')
            ->take($length)->skip($start)->get();
        return $company2;
    }


    public function siteClients(Request $request)
    {
        $companies = Company::query();
        $companies->where('endSubscription', '0');


        $cities = City::all();
        $catagories = Catagory::all();

        $city = $request->get('city');
        $catagory = $request->get('catagory');

        if ($city > 0) {
            $companies->where('city_id', $city);
        }
        if ($catagory > 0) {
            $companies->where('catagory_id', $catagory);
        }

        $companies = $companies->paginate(24);

        return view('site.clients.clients', compact('companies'), compact('cities'))
            ->with('catagories', $catagories);
    }


    // Display Video's of the clicked company in index page
    public function showCompany($id)
    {
        $company = Company::where('endSubscription', '0')->find($id);
        return view('site.clients.companyShow', compact('company'));

    }

    // redirect to the view that display companies that ended subscibe
    public function ended()
    {
        return view('dashboard.companies.ended');
    }

    public function Endeddatatable(Request $request)
    {
//        dd($request->all());
        $length = Input::get('length');
        $start = Input::get('start');
        $search = Input::get('search');
        $search = $search['value'];

        $orderCol = Input::get(('order'));
        $orderDir = Input::get(('order'));

        $orderCol = $orderCol[0]['column'];
        $orderDir = $orderDir[0]['dir'];

        $company = Company::query()->whereDate('end_subscription', '<=', Carbon::now());

        if ($orderCol != null) {
            if ($orderCol == 1) {
                $company->orderBy('name_ar', $orderDir);
            } elseif ($orderCol == 2) {
                $company->orderBy('name_en', $orderDir);
            }
        }

        if ($search != null) {
            $company =  $company->where('name_ar', 'like', '%' . $search . '%')
                                ->where('name_en', 'like', '%' . $search . '%');
        }
        $company2['iTotalRecords'] = $company->count();
        $company2['iTotalDisplayRecords'] = $company->count();
        $company2['sEcho'] = 0;
        $company2['sColumns'] = '';

         $company2['data'] = $company->take($length)->skip($start)->get();
         return $company2;
    }

    public function deactivate($id , Request $request)
    {
        $com = Company::find($id);
        $com->endSubscription = !$com->endSubscription;
        $com->save();

        if ($request->ajax()){

            return '1';
        }
        return redirect()->back();
    }


}
