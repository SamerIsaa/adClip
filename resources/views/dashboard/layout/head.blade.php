<!--begin::Base Path (base relative path for assets of this page) -->
<base href="../">

<!--end::Base Path -->
<meta charset="utf-8"/>
<title>Metronic | Dashboard</title>
<meta name="description" content="Updates and statistics">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--begin::Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
        },
        active: function () {
            sessionStorage.fonts = true;
        }
    });
</script>

<!--end::Fonts -->

<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{ asset('dashboardAssets') }}/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet"
      type="text/css" />

<!--end::Page Vendors Styles -->

<!--begin:: Global Mandatory Vendors -->
<link href="{{ asset('dashboardAssets') }}/vendors/general/perfect-scrollbar/css/perfect-scrollbar.rtl.css"
      rel="stylesheet" type="text/css"/>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<link href="{{ asset('dashboardAssets') }}/vendors/general/tether/dist/css/tether.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.rtl.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-daterangepicker/daterangepicker.rtl.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.rtl.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-select/dist/css/bootstrap-select.rtl.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/select2/dist/css/select2.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/ion-rangeslider/css/ion.rangeSlider.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/owl.carousel/dist/assets/owl.theme.default.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/dropzone/dist/dropzone.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/summernote/dist/summernote.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.rtl.css"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/animate.css/animate.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/toastr/build/toastr.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/morris.js/morris.rtl.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/sweetalert2/dist/sweetalert2.rtl.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/vendors/general/@fortawesome/fontawesome-free/css/all.min.rtl.css"
      rel="stylesheet" type="text/css"/>

<!--end:: Global Optional Vendors -->


<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ asset('dashboardAssets') }}/css/demo1/pages/general/login/login-3.rtl.css" rel="stylesheet" type="text/css"/>

<!--end::Page Custom Styles -->


<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ asset('dashboardAssets') }}/css/demo1/style.bundle.rtl.min.css" rel="stylesheet" type="text/css"/>

<!--end::Global Theme Styles -->
@yield('css')

<!--begin::Layout Skins(used by all pages) -->
<link href="{{ asset('dashboardAssets') }}/css/demo1/skins/header/base/light.rtl.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/css/demo1/skins/header/menu/light.rtl.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/css/demo1/skins/brand/dark.rtl.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('dashboardAssets') }}/css/demo1/skins/aside/dark.rtl.css" rel="stylesheet" type="text/css"/>

<!--end::Layout Skins -->
<link rel="shortcut icon" href="{{ asset('dashboardAssets') }}/media/logos/favicon.ico"/>

