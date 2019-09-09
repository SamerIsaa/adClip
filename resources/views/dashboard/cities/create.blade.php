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
                                إضافة مدينة
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('city.store') }}" method="post" id="kt_form_1">
                        @csrf

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


                            <div class="form-group">
                                <label>اسم المدينة باللغة العربية</label>
                                <input type="text" class="form-control form-control-lg text-left" aria-describedby="emailHelp"
                                       placeholder="اسم المدينة باللغة العربية" name="name_ar" value="{{ old('name_ar') }}">
                            </div>
                            <div class="form-group">
                                <label>اسم المدينة باللغة الإنجليزية</label>
                                <input type="text" class="form-control form-control-lg text-left" aria-describedby="emailHelp"
                                       placeholder="اسم المدينة باللغة الإنجليزية" name="name_en" value="{{ old('name_en') }}">
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
                        }
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
    </script>
@endsection