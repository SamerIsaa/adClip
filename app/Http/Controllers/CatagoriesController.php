<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Http\Requests\CatagoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CatagoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.catagories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.catagories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatagoryRequest $request)
    {

        $data = $request->all();

        try{
            Catagory::create($data);
            session()->flash('success' , 'تم اضافة التصنيف بنجاح');
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
            $catagory = Catagory::findOrFail($id);
            return view('dashboard.catagories.edit', compact('catagory'));
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
    public function update(CatagoryRequest $request, $id)
    {
        try{
            $catagory  = Catagory::findOrFail($id);
            $catagory->update($request->all());

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
            Catagory::destroy($request['id']);
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

        $catagory = Catagory::query();

        if ($orderCol != null) {
            if ($orderCol == 1) {
                $catagory->orderBy('name_ar', $orderDir);
            } elseif ($orderCol == 2) {
                $catagory->orderBy('name_en', $orderDir);
            }
        }

        if ($search != null) {
            $catagory = $catagory->orWhere('name_ar', 'like', '%' . $search . '%')
                ->orWhere('name_en', 'like', '%' . $search . '%');
        }

        $catagory2['iTotalRecords'] = $catagory->count();
        $catagory2['iTotalDisplayRecords'] = $catagory->count();
        $catagory2['sEcho'] = 0;
        $catagory2['sColumns'] = '';

        $catagory2['data'] = $catagory->take($length)->skip($start)->get();
        return $catagory2;
    }


}
