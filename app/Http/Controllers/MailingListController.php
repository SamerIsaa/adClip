<?php

namespace App\Http\Controllers;

use App\MailingList;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    /*
     * this method for save emails to our database
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email|unique:mailing_lists,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 500);
        }

        MailingList::create($data);
        return response(['success'], '200');
    }

    public function create()
    {
        return view('dashboard.mailingNews.create');
    }


    // for sending mailing news
    public function send(Request $request)
    {
        $emails = MailingList::all();

        $view = $request->get('news');

        foreach ($emails as $email) {
            Mail::send([], [], function ($news) use ($email , $view) {
                $news->from('info@adclip.com', 'AdClip')
                    ->setBody($view, 'text/html')
                    ->setSubject('Daily News');
                $news->to($email->email);
            });
        }


        session()->flash('success', 'تم ارسال النشرة بنجاح');
        return redirect()->back();

    }
}
