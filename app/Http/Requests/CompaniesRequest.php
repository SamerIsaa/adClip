<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'city_id' => 'required|exists:cities,id',
            'catagory_id' => 'required|exists:catagories,id',
            'subscription' => 'required|date',
            'days' => 'required|numeric|gte:1',
            'logo' => 'required|image'
        ];
    }


    public function messages()
    {
        return [
            'name_ar.required' => 'إسم الشركة باللغة العربية مطلوب',
            'name_en.required' => 'إسم الشركة باللغة الإنجليزية مطلوب',
            'description_ar.required' => 'وصف الشركة باللغة العربية مطلوب',
            'description_en.required' => 'وصف الشركة باللغة الإنجليزية مطلوب',
            'city_id.required' => 'يجب عليك اختيار المدينة',
            'city_id.exists' => 'المدينة التي قمت باختيارها غير مدرجة لدينا',
            'catagory_id.required' => 'يجب عليك اختيار التصنيف',
            'catagory_id.exists' => 'التصنيف الذي قمت باختياره غير مدرج لدينا',
            'subscription.required' => 'يجب ادخال تاريخ الاشتراك ',
            'days.required' => 'عدد ايام الاشتراك مطلوبة',
            'days.gte' => 'يجب ان يكون عدد ايام الاشتراك اكبر او يساوي 1',
            'days.numeric' => 'يجب ان يكون عدد الايام رقم',
            'logo.required' => 'يرجى رفع شعار الشركة',
            'logo.image' => 'يجب ان يكون الشعار عبارة عن صورة',

        ];
    }
}
