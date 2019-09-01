<?php

namespace App\Http\Controllers;

use App\About;
use Validator;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::select('about_ar' , 'about_en')->first();
        return view('site.about', compact('about'));
    }
    public function socialView()
    {
        $social = About::first();
        if ($social == null){
            $social = new About();
            $social->save();
        }

        return view('dashboard.abouts.social',compact('social'));
    }

    public function socialStore(Request $request)
    {
        $data = $request->all();

        $messages = [
            'facebook.required'     => 'رابط الفيسبوك مطلوب',
            'facebook.url'          => 'يجب ان يكون رابط صحيح ',
            'twitter.required'      => 'رابط التويتر مطلوب',
            'twitter.url'           => 'يجب ان يكون رابط صحيح',
            'instagram.required'    => 'رابط الإنستقرام مطلوب',
            'instagram.url'         => 'يجب ان يكون رابط صحيح',
        ];
        $validator = Validator::make($data , [
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
        ] , $messages);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        About::find($request->id)->update($data);

        session()->flash('success' , 'تمت عملية التعديل بنجاح');
        return redirect()->back();

    }

    public function aboutUsView()
    {
        $aboutUs = About::first();
        if ($aboutUs == null){
            $aboutUs = new About();
            $aboutUs->save();
        }

        return view('dashboard.abouts.aboutUs',compact('aboutUs'));
    }


    public function aboutUsStore(Request $request)
    {
        $data = $request->all();

        $messages = [
            'about_ar.required'     => 'يرجى كتابة نص من نحن باللغة العربية ',
            'about_en.required'      => 'يرجى كتابة نص من نحن باللغة الإنجليزية ',
        ];
        $validator = Validator::make($data , [
            'about_ar' => 'required',
            'about_en' => 'required',
        ] , $messages);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        About::find($request->id)->update($data);

        session()->flash('success' , 'تمت عملية التعديل بنجاح');
        return redirect()->back();
    }
}
