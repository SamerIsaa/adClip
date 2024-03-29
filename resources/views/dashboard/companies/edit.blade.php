@extends('dashboard.layout.master')



@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">

            <div class="col-md-12">


                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                تعديل شركة
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('company.update' , $company->id) }}" method="post" id="kt_form_1">
                        @csrf
                        @method('put')

                        <div class="form-group form-group-last kt-hide">
                            <div class="alert alert-danger" role="alert" id="kt_form_1_msg">
                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                <div class="alert-text">
                                    Oh snap! Change a few things up and try submitting again.
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="kt-portlet__body ">

                            {{--                             if any error happen from validation--}}
                            @if($errors->any())
                                <div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                                    <div class="alert-text">{{ $errors->first() }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                            @endif


                            {{--                            // if the creation for the admin complete successfully--}}
                            @if(session('success'))
                                <div class="alert alert-success fade show" role="alert" >
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">{{ session('success') }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger fade show" role="alert" >
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">{{ session('error') }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                            @endif


                            <div class="form-group">
                                <label>اسم الشركة باللغة العربية</label>
                                <input type="text" class="form-control form-control-lg text-left"
                                       aria-describedby="emailHelp"
                                       placeholder="اسم الشركة باللغة العربية" name="name_ar"
                                       value="{{ $company->name_ar }}">
                            </div>
                            <div class="form-group">
                                <label>اسم الشركة باللغة الإنجليزية</label>
                                <input type="text" class="form-control form-control-lg text-left"
                                       aria-describedby="emailHelp"
                                       placeholder="اسم الشركة باللغة الإنجليزية" name="name_en"
                                       value="{{ $company->name_en }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">وصف الشركة باللغة العربية</label>
                                <textarea class="form-control form-control-lg" id="exampleTextarea" rows="3"
                                          name="description_ar">{{ $company->description_ar }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">وصف الشركة باللغة الإنجليزية</label>
                                <textarea class="form-control form-control-lg" id="exampleTextarea" rows="3"
                                          name="description_en">{{ $company->description_en }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label col-lg-3 col-sm-12">التصنيف</label>
                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                    <select class="form-control kt-select2" id="kt_select2_1" name="catagory_id">
                                        @if($catagories)

                                            @foreach($catagories as $catagory)
                                                <option value="{{$catagory->id}}">{{ $catagory->name_ar }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label col-lg-3 col-sm-12">المدينة</label>
                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                    <select class="form-control kt-select2" id="kt_select2_1" name="city_id">
                                        @if($cities)

                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{ $city->name_ar }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <input type="hidden" value="{{ $company->subscription }}" name="subscription">


                            <div class="form-group">
                                <label for="example-number-input" class="col-2 col-form-label">تمديد ايام الاشتراك</label>
                                <div class="col-12">
                                    <input class="form-control form-control-lg"
                                           name = "extra_days" type="number" value="0" id="example-number-input">
                                </div>
                            </div>


                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions " style="text-align: left;">
                                <button type="submit" class="btn btn-success">حفظ</button>
                                <button type="reset" class="btn btn-secondary">إلغاء</button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->

            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@section('js')

    <script>


        var KTFormControls = function () {
            // Private functions

            var demo1 = function () {
                $( "#kt_form_1" ).validate({
                    // define validation rules
                    rules: {
                        name_ar: {
                            required: true,
                        },
                        name_en: {
                            required: true
                        },
                        description_ar: {
                            required: true,
                            minlength: 5,
                        },
                        description_en: {
                            required: true,
                            minlength: 5,
                        },
                        city_id: {
                            required: true,
                        },
                        catagory_id: {
                            required: true
                        },
                        subscription: {
                            required: true,
                        },
                        days: {
                            required: true,
                            digits: true

                        },
                    },

                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        var alert = $('#kt_form_1_msg');
                        alert.removeClass('kt--hide').show();
                        KTUtil.scrollTop();
                    },

                    submitHandler: function (form) {
                        form[0].submit(); // submit the form
                    }
                });
            }


            return {
                // public functions
                init: function() {
                    demo1();

                }
            };
        }();

        jQuery(document).ready(function() {
            KTFormControls.init();
        });
    </script>@endsection
