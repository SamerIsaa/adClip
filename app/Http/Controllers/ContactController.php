<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.contacts.index');
    }


    public function create()
    {
        return view('site.contact');
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
        Contact::create($data);
        Mail::send(new ContactMail($request));


        return 'true';

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
        return "1";
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


        $contact = Contact::query();


        if ($orderCol != null) {
            if ($orderCol == 1) {
                $contact->orderBy('name', $orderDir);
            } elseif ($orderCol == 2) {
                $contact->orderBy('email', $orderDir);
            } elseif ($orderCol == 3) {
                $contact->orderBy('title', $orderDir);
            }
        }

        if ($search != null) {
            $contact = $contact->orWhere('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%')
                                ->orWhere('title', 'like', '%' . $search . '%');
        }

        $contact2['iTotalRecords'] = $contact->count();
        $contact2['iTotalDisplayRecords'] = $contact->count();
        $contact2['sEcho'] = 0;
        $contact2['sColumns'] = '';

        $contact2['data'] = $contact->orderBy('created_at' , 'desc')->take($length)->skip($start)->get();
        return $contact2;
    }

    public function replay($id)
    {
        $contactMsg = Contact::find($id);
        return view('dashboard.contacts.replay' , compact('contactMsg'));

    }

    public function sendReplay(Request $request)
    {
        $email = $request->email;

        $view = $request->get('message');

        Mail::send([], [], function ($news) use ($email , $view) {
            $news->from('samer.isaa1996@gmail.com', 'ADclip')
                ->setBody($view, 'text/html')
                ->setSubject('Replay');
            $news->to($email);
        });


        session()->flash('success', 'تم ارسال الرد بنجاح');
        return redirect()->back();

    }
}
