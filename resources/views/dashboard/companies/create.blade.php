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
                    <form class="kt-form" action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                <div class="alert alert-success fade show" role="alert">
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
                                <label>اسم الشركة باللغة العربية</label>
                                <input type="text" class="form-control form-control-lg text-left"
                                       aria-describedby="emailHelp"
                                       placeholder="اسم الشركة باللغة العربية" name="name_ar"
                                       value="{{ old('name_ar') }}">
                            </div>
                            <div class="form-group">
                                <label>اسم الشركة باللغة الإنجليزية</label>
                                <input type="text" class="form-control form-control-lg text-left"
                                       aria-describedby="emailHelp"
                                       placeholder="اسم الشركة باللغة الإنجليزية" name="name_en"
                                       value="{{ old('name_en') }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">وصف الشركة باللغة العربية</label>
                                <textarea class="form-control form-control-lg" id="exampleTextarea" rows="3"
                                          name="description_ar">{{ old('description_ar') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">وصف الشركة باللغة الإنجليزية</label>
                                <textarea class="form-control form-control-lg" id="exampleTextarea" rows="3"
                                          name="description_en">{{ old('description_en') }}</textarea>
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


                            <div class="form-group">
                                <label class="col-form-label col-lg-3 col-sm-12">تاريخ الاشتراك</label>
                                <div class="col-lg-12 col-md-9 col-sm-12">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="subscription"
                                                readonly id="kt_datetimepicker_3" value="{{ old('subscription') }}"/>
                                        <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar glyphicon-th"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-number-input" class="col-2 col-form-label">عدد ايام الاشتراك</label>
                                <div class="col-12">
                                    <input class="form-control form-control-lg"
                                           name = "days" type="number" value="{{ old('days') ? old('days') : 0 }}" id="example-number-input">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>شعار الشركة</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="logo">
                                    <label class="custom-file-label" for="customFile">اختار الشعار</label>
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
    <script src="{{ asset('dashboardAssets') }}/js/demo1/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
    <script src="{{ asset('dashboardAssets') }}/js/demo1/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

@endsection