@extends('site.layout.master')

@section('title')
    {{ __('site.clients') }}
@endsection
@section('content')

    <section class="s_2">
        <div class="container">
            <div class="header_divs">
                <h2>
                    @if(app()->isLocale('ar'))
                        {{ strtoupper($company->name_ar) }}
                    @else
                        {{ strtoupper($company->name_en) }}
                    @endif
                </h2>
                <p>
                    @if(app()->isLocale('ar'))
                        {{ $company->description_ar }}
                    @else
                        {{ $company->description_en }}
                    @endif
                </p>
            </div>
{{--            {{ asset($company->videos->first()->path) }}--}}
            <div class="item_s2 abouts">
                <div class="col-md-8 col-md-offset-2">
                    <div class="video-container">

                            <video class="video-fluid" id="video" autoplay controls muted width="100%" >
                                <source src="noAd" type="video/mp4" />
                            </video>

                    </div>
                </div>
                <div class="list_video">
                    <ul>

                        @if($company->videos)
                            @foreach( $company->videos as $video)

                                <li onclick="setVedio( '{{ asset($video->path) }}' )">
                                    <a href="javascript:;">
                                        <img src="{{ asset('siteAssets/') }}/images/Layer3.png">
                                    </a>
                                </li>

                            @endforeach
                        @endif


                    </ul>
                </div>
            </div>
        </div>
    </section>



@endsection


@section('js')
    <script>
        $(document).ready(function () {
            let compId = "{{ $company->id }}";
            getAd(compId);
        })
        {{--let adArray = "{{ $company->videos->toArray() }}"--}}
        {{--player.bind("ended", function() {--}}
        {{--    if (index == adArray.length -1){--}}
        {{--        index = 0;--}}
        {{--    }else{--}}
        {{--        index++;--}}
        {{--    }--}}
        {{--    player.setAttribute('src' , "{{ asset('/') }}" + adArray[index]['path']);--}}

        {{--});--}}
        function setVedio(path) {
            let player = document.getElementById('video');
            player.setAttribute("src",path);
        }


        function getAd(compId) {
            $.ajax({
                url: "{{ url('comp-ad') }}/" + compId,
                method: "GET",

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
@endsection