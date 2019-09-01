<!doctype html>
<html lang="{{ app()->getLocale() }}" class="no-js">

<head>
    <title>
        {{ __('site.home') }}
    </title>
    <meta name="Keywords" content="AD Click"/>
    <meta name="Description" content="AD Click"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="AD Click"/>

    <!-- <meta property="og:image" content="images/madad.png" /> -->

    <meta property="og:description" content="AD Click"/>


    <!-- <meta name="theme-color" content="#000"> -->
    <link rel="stylesheet" href="{{ asset('siteAssets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('siteAssets') }}/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{ asset('siteAssets') }}/css/bootstrap-select.css">
    <link rel="stylesheet" href="{{ asset('siteAssets') }}/css/font-style.css">
    <link rel="stylesheet" href="{{ asset('siteAssets') }}/css/style.css">


</head>
<body>
<section class="header-section-owl">

    @include('site.layout.header')

    <div class="container">
        <div class="item-slider1-index">
            <div class="row">
                <div class="col-md-5">
                    <div class="text_header">
                        <ul>
                            <li><a href="javascript:;" class="catagories" name="سيارات"><i class="icon-car-compact"></i>{{ __('site.cars') }}</a></li>
                            <li><a href="javascript:;" class="catagories" name="فنادق"><i class="icon-bed1"></i>{{ __('site.hotels') }}</a></li>
                            <li><a href="javascript:;" class="catagories" name="عيادات"><i class="icon-medical-kit"></i>{{ __('site.clinics') }}</a></li>
                            <li><a href="javascript:;" class="catagories" name="مستشفيات"><i class="icon-heart-rate-monitor"></i>{{ __('site.hospitals') }}</a></li>
                            <li><a href="javascript:;" class="catagories" name="محلات تجارية"><i class="icon-factory-building"></i>{{ __('site.shops') }}</a></li>
                            <li><a href="javascript:;" class="catagories" name="شركات"><i class="icon-office-block"></i>{{ __('site.companies') }}</a></li>
                        </ul>
                        <div class="search_head">
                            <h2>البحث</h2>
                            <ul>
                                <li>
                                    <select class="selectpicker" id="city">
                                        @if($cities)
                                            <option value="0">
                                                @if(app()->isLocale('ar'))
                                                    المدن
                                                @else
                                                    Cities
                                                @endif
                                            </option>
                                            @foreach($cities as $city)
                                                @if(app()->isLocale('ar'))
                                                    <option value="{{ $city->id }}">{{ $city->name_ar }}</option>
                                                @else
                                                    <option value="{{ $city->id }}">{{ $city->name_en }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </li>
                                <li>
                                    <select class="selectpicker" id="catagory">
                                        @if($catagories)
                                            <option value="0">
                                                @if(app()->isLocale('ar'))
                                                    التصنيفات
                                                @else
                                                    Catagories
                                                @endif
                                            </option>
                                            @foreach($catagories as $catagory)
                                                @if(app()->isLocale('ar'))
                                                    <option value="{{ $catagory->id }}">{{ $catagory->name_ar }}</option>
                                                @else
                                                    <option value="{{ $catagory->id }}">{{ $catagory->name_en }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </li>
                            </ul>
                            <button type="button" onclick="filterClients()">{{ __('site.search') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="video-container">
{{--                        <iframe width="100%" height="400" src="https://player.vimeo.com/video/117910068" frameborder="0"--}}
{{--                                webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>--}}

                        <video class="video-fluid" id="video" autoplay controls muted width="100%" >
                            <source src="https://mdbootstrap.com/img/video/Lines.mp4" type="video/mp4" />
                        </video>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="s_2">
    <div class="container">
        <div class="header_divs">
            <h2>{{ __('site.clients') }}</h2>
            <p>{{ __('site.clientsMsg') }}</p>
        </div>
        <div class="item_s2">
            <ul>

                @if($companies)
                    @foreach($companies as $company)
                        <li onclick="window.location = '{{ url('client/') . '/'.  $company->id }}'">
                            <div>
                                <div class="imgsq">
                                    <img src="{{ asset($company->logo) }}">
                                </div>
                                <p>{{ $company->name_ar }}</p>
                            </div>
                        </li>
                    @endforeach
                @endif


            </ul>
            <a href="{{ route('clients.index' ,['city_id'=> 0 , 'catagory_id' => 0]) }}">{{ __('site.more') }}</a>
        </div>
    </div>
</section>

@include('site.layout.mailingList')

@include('site.layout.footer')


@include('site.layout.scripts')


<script type="text/javascript">

    function filterClients(e) {
        let city_id = $('select#city').val();
        let catagory_id = $('select#catagory').val();
        window.location = "{{ url('clients') }}/" + city_id + "/" + catagory_id;
    }

    $(document).ready(function () {

        getAd('');
        $('a.catagories').click(function () {
            let catName = $(this)[0].name;
            getAd(catName);

        });
    });

    function getAd(catName) {
        $.ajax({
            url: "{{ url('comp-ad') }}",
            method: "GET",
            data: {
                'catagory': catName
            },
            success: function (response) {
                if (response.status == 'true') {

                    let adArray = response.data;
                    let player = document.getElementById('video');

                    if (adArray.length > 0){

                        let index = 0 ;

                        player.setAttribute('src' , "{{ asset('/') }}" + adArray[index]['path']);
                        $("#video").bind("ended", function() {
                            if (index == adArray.length -1){
                                index = 0;
                            }else{
                                index++;
                            }
                            player.setAttribute('src' , "{{ asset('/') }}" + adArray[index]['path']);

                        });
                    } else {
                        player.setAttribute('src' , "No Ad");

                    }


                }
            }
        });
    }

</script>
</body>
</html>