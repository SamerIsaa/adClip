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

                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{ route('about-us.store') }}"
                          method="post">
                        @csrf




                        <div class="kt-portlet__body">
                            <input type="hidden" name="id" value="{{ $aboutUs->id }}">

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


                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">من نحن باللغة العربية</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <textarea class="summernote" id="kt_summernote_1" name="about_ar">
                                        {{ $aboutUs->about_ar }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12">من نحن باللغة الإنجليزية</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <textarea class="summernote" id="kt_summernote_1" name="about_en">
                                        {{ $aboutUs->about_en }}
                                    </textarea>
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
    <script src="{{ asset('dashboardAssets' ) }}/js/demo1/pages/crud/forms/widgets/summernote.js"
            type="text/javascript"></script>
@endsection

