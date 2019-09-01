@extends('dashboard.layout.master')



@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Section-->
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-xl">
                    <div class="col-md-12 col-lg-12 col-xl-4">

                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="kt-widget1">

                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">شعار الشركة</h3>
                                    <img src="{{ asset($company->logo) }}" width="200px"  height="200px"alt="">
                                </div>
                            </div>

                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">إسم الشركة باللغة العربية</h3>
                                    <span class="kt-widget1__desc">{{ $company->name_ar }}</span>
                                </div>
                            </div>
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">إسم الشركة باللغة الإنجليزية</h3>
                                    <p class="kt-widget1__desc">{{ $company->name_en }}</p>
                                </div>
                            </div>
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">وصف الشركة باللغة العربية</h3>
                                    <span class="kt-widget1__desc">{{ $company->description_ar }}</span>
                                </div>
                            </div>
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">وصف الشركة باللغة الإنجليزية</h3>
                                    <span class="kt-widget1__desc">{{ $company->description_en }}</span>
                                </div>
                            </div>

                        </div>

                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4">

                        <!--begin:: Widgets/Stats2-2 -->
                        <div class="kt-widget1">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">المدينة</h3>
                                    <span class="kt-widget1__desc">{{ $company->city->name_ar }}</span>
                                </div>
                            </div>
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">التصنيف</h3>
                                    <span class="kt-widget1__desc">{{ $company->catagory->name_ar }}</span>
                                </div>
                            </div>

                        </div>

                        <!--end:: Widgets/Stats2-2 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4">

                        <!--begin:: Widgets/Stats2-3 -->
                        <div class="kt-widget1">
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">تاريخ الإشتراك</h3>
                                    <span class="kt-widget1__desc text-right">{{ $company->subscription }}</span>
                                </div>
                            </div>
                            <div class="kt-widget1__item">
                                <div class="kt-widget1__info">
                                    <h3 class="kt-widget1__title">تاريخ نهاية الإشتراك</h3>
                                    <span class="kt-widget1__desc text-right">{{ $company->end_subscription }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions " style="text-align: left;">
                                <button type="button" class="btn btn-success"
                                        onclick="window.location = '{{ url()->previous() }}'">
                                    رجوع</button>
                            </div>
                        </div>

                        <!--end:: Widgets/Stats2-3 -->
                    </div>
                </div>
            </div>
        </div>

        <!--End::Section-->


    </div>

    <!-- end:: Content -->

@endsection

