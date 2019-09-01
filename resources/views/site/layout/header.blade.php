<section class="header-section-owl page">

    <div class="header">
        <div class="container">
            <div class="headers">
                <div class="menu-side">
                    <div class="btn-menu-close"><i class="icon-delete2"></i></div>
                    <ul class="menu-sidebar">
                        <li><a href="#" ><i class="icon-web-page-home"></i>{{ __('site.home') }}</a></li>
{{--                        <li><a href="#" ><i class="icon-star2"></i>{{ __('site.features') }}</a></li>--}}
                        <li><a href="{{ route('about.index') }}" ><i class="icon-man-user"></i>{{ __('site.whoWeAre') }}</a></li>
                        <li><a href="{{ route('clients.index' ,['city_id'=> 0 , 'catagory_id' => 0]) }}" ><i class="icon-multiple-users-silhouette"></i>{{ __('site.clients') }}</a></li>
                        <li><a href="{{ route('contact.create') }}" ><i class="icon-envelope"></i>{{ __('site.contact') }}</a></li>
                    </ul>
                    <ul class="menu-sidebar sid2q">
                        <li><a href="{{ $social->facebook }}" target="_blank"><i class="icon-facebook"></i></a></li>
                        <li><a href="{{ $social->twitter }}" target="_blank"><i class="icon-twitter"></i></a></li>
                        <li><a href="{{ $social->instagram }}" target="_blank"><i class="icon-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="back-menu"></div>
                <div id="main-menu">
                    <div class="btn-menu"><i class="icon-menu-options"></i></div>
                    <div class="header-2">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-8 pull-right navigation">
                                    <div class="logo-img">
                                        <a href="{{ url('/') }}"><img src="{{ asset('siteAssets') }}/images/logo.png"></a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 pull-right navigation">
                                    <nav class="navbar navbar-default">
                                        <div class="container-fluid">
                                            <div class="collapse navbar-collapse" id="defaultNavbar1">
                                                <ul class="head-menu4 nav navbar-nav avbar-left">
                                                    <li><a  href="{{ $social->facebook }}" target="_blank"><i class="icon-facebook"></i></a></li>
                                                    <li><a  href="{{ $social->twitter }}" target="_blank"><i class="icon-twitter"></i></a></li>
                                                    <li><a  href="{{ $social->instagram }}" target="_blank"><i class="icon-instagram"></i></a></li>
                                                </ul>
                                                <ul class="head-menu3 nav navbar-nav avbar-right">
{{--                                                    <li><a href="#" ><i class="icon-star2"></i>{{ __('site.features') }}</a></li>--}}
                                                    <li><a href="{{ route('about.index') }}" ><i class="icon-man-user"></i>{{ __('site.whoWeAre') }}</a></li>
                                                    <li><a href="{{ route('clients.index',['city_id'=> 0 , 'catagory_id' => 0] ) }}" ><i class="icon-multiple-users-silhouette"></i>{{ __('site.clients') }}</a></li>
                                                    <li><a href="{{ route('contact.create') }}" ><i class="icon-envelope"></i>{{ __('site.contact') }}</a></li>
                                                </ul>
                                            </div><!-- /.navbar-collapse -->
                                        </div><!-- /.container-fluid -->
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


