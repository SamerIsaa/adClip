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
                                تعديل مدير
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('catagory.update' , $catagory->id) }}" method="post">
                        @csrf
                        @method('put')
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
                                <label>اسم التصنيف باللغة العربية</label>
                                <input type="text" class="form-control form-control-lg text-left" aria-describedby="emailHelp"
                                       placeholder="اسم التصنيف باللغة العربية" name="name_ar" value="{{ $catagory->name_ar }}">
                            </div>
                            <div class="form-group">
                                <label>اسم التصنيف باللغة الإنجليزية</label>
                                <input type="text" class="form-control form-control-lg text-left" aria-describedby="emailHelp"
                                       placeholder="اسم التصنيف باللغة الإنجليزية" name="name_en" value="{{ $catagory->name_en }}">
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

