<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Company;
use App\CompanyVideo;
use App\Http\Requests\CompanyVideoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('dashboard.companyVideo.index', compact('company'));
        } catch (\Exception $exception) {

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('dashboard.companyVideo.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CompanyVideo::create($request->all());
        return $request->company_id;
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

            $companyAd = CompanyVideo::find($id);
            return view('dashboard.companyVideo.show', compact('companyAd'));
        } catch (\Exception $exception) {
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
        return view('dashboard.companyVideo.edit', compact('id'));
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

        try {
            $companyAd = CompanyVideo::findOrFail($id);
            // if the request from update path with the new path
            if ($request->has('path')) {
                if ($companyAd->path != '') {
                    unlink($companyAd->path);
                }
                $companyAd->path = $request->get('path');
                $companyAd->save();
                return '1';
            } // if the request from delete path with the empty 8path
            else {
                $companyAd->path = '';
                $companyAd->save();
                return '1';
            }


        } catch (\Exception $exception) {
            return '2';
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
            $ad = CompanyVideo::find($request['id']);
            if ($ad->path != '')
                unlink($ad->path);
            $ad->delete();

            return "1";
        } catch (\Exception $e) {
            return "2";
        }
    }


    public function datatable(Request $request)
    {
        $length = Input::get('length');
        $start = Input::get('start');


        $companyAd = CompanyVideo::query();

        $companyAd->where('company_id', $request['company_id']);

        $companyAd2['iTotalRecords'] = $companyAd->count();
        $companyAd2['iTotalDisplayRecords'] = $companyAd->count();
        $companyAd2['sEcho'] = 0;
        $companyAd2['sColumns'] = '';

        $companyAd2['data'] = $companyAd->take($length)->skip($start)->get();
        return $companyAd2;
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('company_ad')) {

            $ad = $request->file('company_ad');
            $name = date('Y-m-d') . '-' . $ad->getClientOriginalName();

            $path = 'uploades';
            $fullPath = $path . '/' . $name;
            $ad->move($path, $name);

            return $fullPath;
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {

            unlink($request->path);
            return "1";

        }

    }

    public function getAd(Request $request)
    {
        $ad = CompanyVideo::query();
        $cat_name = $request->get('catagory');


        if ($cat_name != '') {
            $id = Catagory::where('name_ar' , $cat_name)->first()->id;
            $ad->orWhereHas('company' , function ($query) use($id){
               $query->where('catagory_id' ,$id );
            });
        }

        $ad = $ad->get();

        return response([
            'status' => 'true',
            'data'  => $ad
        ]);
    }

    public function getAdForCompany($id)
    {
        $ad = CompanyVideo::where('company_id' , $id)->get();

        return response([
            'status' => 'true',
            'data'  => $ad
        ]);
    }
}
