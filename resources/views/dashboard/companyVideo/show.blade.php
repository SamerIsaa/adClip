@extends('dashboard.layout.master')



@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        مشاهدة الإعلان
                    </h3>
                </div>
            </div>

            <div align="center" class="embed-responsive embed-responsive-16by9">
                <video autoplay controls loop class="embed-responsive-item">
                    <source src="{{ asset($companyAd->path) }}" type="video/mp4">
                    <source src="{{ asset($companyAd->path) }}" type="video/WebM">
                    <source src="{{ asset($companyAd->path) }}" type="video/Ogg">
                </video>
            </div>
        </div>

        <!--end::Portlet-->
    </div>

    <!-- end:: Content -->

@endsection

