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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ( $ad = $request->file('ad')){

            $name = date('Y-m-d') . '-' . $ad->getClientOriginalName();

            $path = 'uploades';
            $fullPath = $path . '/' . $name;
            $ad->move($path, $name);

            CompanyVideo::create([
                'company_id'    => $data['company_id'],
                'path'          => $fullPath
            ]);
        }

        return redirect()->back();
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

        $companyAd2['data'] = $companyAd->take($length)->skip($start)->orderBy('created_at' , 'desc')->get();
        return $companyAd2;
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
