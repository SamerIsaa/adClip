<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->
<head>

    @include('dashboard.layout.head')

</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
             style="background-image: url(dashboardAssets/media//bg/bg-3.jpg);">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="">
                            <img src="{{ asset('dashboardAssets') }}/media/logos/logo-5.png">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">تسجيل الدخول للوحة التحكم</h3>
                        </div>
                        <form class="kt-form" action="{{ route('admin.login') }}" method="post">

                            @if($errors->any())
                                <div class="kt-alert kt-alert--outline alert alert-danger alert-dismissible text-left"
                                     role="alert" style="flex-direction: row-reverse">

                                    <span>{{ $errors->first() }}</span>
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close" >
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endif

                                @if(session('error'))
                                    <div class="kt-alert kt-alert--outline alert alert-danger alert-dismissible text-left"
                                         role="alert" style="flex-direction: row-reverse">

                                        <span>{{ session('error') }}</span>
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close" >
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                @endif
                            @csrf
                            <div class="input-group">
                                <input class="form-control text-left" type="text"
                                       placeholder="البريد الألكتروني او اسم المستخدم" name="login"
                                       value="{{ old('login') }}" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <input class="form-control text-left" type="password" placeholder="كلمة المرور"
                                       name="password">
                            </div>
                            <div class="row kt-login__extra">

                                <div class="col kt-align-right">
                                    <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">نسيت كلمة
                                        المرور؟</a>
                                </div>

                                <div class="col pull-right">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember"> تذكرني
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button class="btn btn-brand btn-elevate kt-login__btn-primary">دخول</button>
                            </div>
                        </form>
                    </div>


                    <div class="kt-login__forgot">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">نسيت كلمة المرور ؟</h3>
                            <div class="kt-login__desc">: أدخل بريدك الإلكتروني لإعادة تعيين كلمة المرور الخاصة بك </div>
                        </div>
                        <form class="kt-form" action="">
                            <div class="input-group">
                                <input class="form-control text-left" type="text" placeholder="البريد الإلكتروني" name="email" id="kt_email"
                                       autocomplete="off">
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_forgot_submit"
                                        class="btn btn-brand btn-elevate kt-login__btn-primary">طلب
                                </button>&nbsp;&nbsp;
                                <button id="kt_login_forgot_cancel"
                                        class="btn btn-light btn-elevate kt-login__btn-secondary">إلغاء
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->

@include('dashboard.layout.scripts')

</body>

<!-- end::Body -->
</html>