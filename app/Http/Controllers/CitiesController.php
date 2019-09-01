<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\CitiesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CitiesRequest $request)
    {
        $data = $request->all();

        try{
            City::create($data);
            session()->flash('success' , 'تم اضافة المدينة بنجاح');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error' , 'لقد حدث خطأ ما اثناء الإضافة');
            return redirect()->back();

        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $city = City::findOrFail($id);
            return view('dashboard.cities.edit', compact('city'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CitiesRequest $request, $id)
    {
        try{
            $city  = City::findOrFail($id);
            $city->update($request->all());

            session()->flash('success', 'تمت تعديل التصنيف بنجاح');
            return redirect()->back();

        }catch (\Exception $exception){
            session()->flash('error' ,'لقد حدث خطأ ما');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            City::destroy($request['id']);
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

        $city = City::query();

        if ($orderCol != null) {
            if ($orderCol == 1) {
                $city->orderBy('name_ar', $orderDir);
            } elseif ($orderCol == 2) {
                $city->orderBy('name_en', $orderDir);
            }
        }

        if ($search != null) {
            $catagory = $city->orWhere('name_ar', 'like', '%' . $search . '%')
                ->orWhere('name_en', 'like', '%' . $search . '%');
        }

        $city2['iTotalRecords'] = $city->count();
        $city2['iTotalDisplayRecords'] = $city->count();
        $city2['sEcho'] = 0;
        $city2['sColumns'] = '';

        $city2['data'] = $city->take($length)->skip($start)->get();
        return $city2;
    }

}
