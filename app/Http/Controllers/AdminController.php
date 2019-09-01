<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{


    public function index(Request $request)
    {
        return view('dashboard.admins.index');
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

        $admin = Admin::query();

        if ($orderCol != null) {
            if ($orderCol == 1) {
                $admin->orderBy('name', $orderDir);
            } elseif ($orderCol == 2) {
                $admin->orderBy('user_name', $orderDir);
            } elseif ($orderCol == 3) {
                $admin->orderBy('email', $orderDir);
            }
        }

        if ($search != null) {
            $admin = $admin->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('user_name', 'like', '%' . $search . '%');
        }

        $admin2['iTotalRecords'] = $admin->count();
        $admin2['iTotalDisplayRecords'] = $admin->count();
        $admin2['sEcho'] = 0;
        $admin2['sColumns'] = '';

        $admin2['data'] = $admin->take($length)->skip($start)->get();
        return $admin2;
    }


    public function create()
    {
        return view('dashboard.admins.create');
    }

    /*
     *
     * Validate the request in App\http\Requests\AdminRequest
     *
     */
    public function store(AdminRequest $request)
    {
        /*
         *
         * Get All Data Come From requiest
         * else so the admin will create successfully
         *
         */

        $data = $request->all();
        $admin = new Admin();
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->user_name = $data['user_name'];
        $admin->password = Hash::make($data['password']);

        $admin->save();
        session()->flash('success', 'تمت إضافة المدير بنجاح');
        return redirect()->route('admin.create');
    }



    public function edit($id)
    {

        try {
            $admin = Admin::findOrFail($id);
            return view('dashboard.admins.edit', compact('admin'));
        } catch (\Exception $e) {
            return redirect()->back();
        }

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'password' => 'nullable|min:6',
        ], [
            'name.required'   => 'الأسم مطلوب',
            'password.min'   => 'كلمة المرور يجب ان تتكون من 6 حروف على الأقل',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try{
            $admin = Admin::findOrFail($id);
            $admin->name = $data['name'];
            if (isset($data['password']))
                $admin->password = Hash::make($data['password']);

            $admin->save();

            session()->flash('success' ,'لقد تم تحديث بيانات المدير بنجاح ');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error' ,'لقد حدث خطأ ما');
            return redirect()->back();
        }

    }

    public function destroy(Request $request)
    {

        try {
            Admin::destroy($request['id']);
            return "1";
        } catch (\Exception $e) {
            return "2";
        }


    }

}
