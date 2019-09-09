<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'user_name' => 'required|unique:admins,user_name',
            'password' => 'required|confirmed|min:6',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الأسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالح',
            'email.unique' => 'البريد الإلكتروني الذي قمت بادخاله مُستخدم',
            'user_name.unique' => 'اسم المستخدم الذي قمت بادخاله مُستخدم',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب ان تتكون من 6 حروف على الأقل',
            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقة',

        ];
    }
}
