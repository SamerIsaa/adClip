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
                                النشرة الإخبارية
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('mailingNews.send') }}" method="post">
                        @csrf
                        <div class="kt-portlet__body ">

                            {{-- if any error happen from validation --}}
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


                            {{--  if the creation for the admin complete successfully --}}
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
                                <label class="col-form-label col-lg-3 col-sm-12">الخبر</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <textarea class="summernote" id="kt_summernote_1" name="news"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions " style="text-align: left;">
                                <button type="submit" class="btn btn-success">إرسال</button>
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
