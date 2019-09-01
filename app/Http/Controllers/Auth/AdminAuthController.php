<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminAuthController extends Controller
{

    use AuthenticatesUsers;


    protected $guard = 'admin';

    protected $redirectTo = 'admin/index';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->all();

        // Validate data from login form

        $validator = Validator::make($data , [
           'login'      => 'required|string',
           'password'   => 'required|min:6'
        ] , [
            'login.required'    => 'يرجى ادخال اسم مستخدم او البريد الالكتروني',
            'login.string'    => ' اسم مستخدم او البريد الالكتروني يجب ان يكون نص',
            'password.required'    => 'يرجى ادخال كلمة المرور',
            'password.min'    => 'كلمة المرور يجب ان تتكون من 6 خانات على الأقل',
        ]);

//       IF validor fail in this case then return to login page to attemp again and show error message

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        determine if the user enter user name or email to login using it

        $loginType = filter_var($data['login'] , FILTER_VALIDATE_EMAIL)? "email" : "user_name";

        $request->merge([
            $loginType => $data['login']
        ]);


        /*
         *  Authenticate admin anad redirect it to dashbord if credential is true
         * else where the system will redicect it to login page again
         *
         */


        $credential = $request->only($loginType , 'password');

        if ( Auth::guard('admin')->attempt( $credential , $request->remember ) ){
            return redirect()->intended(route('admin.index1'));

        }else{
            session()->flash('error' , 'خطأ في بيانات الدخول');
            return redirect()->back()->withInput();
        }
    }


//    Logout the Authenticated user and redirect it to login page
    public function logout()
    {
        auth($this->guard)->logout();
        return redirect()->route('admin.login');
    }
}
