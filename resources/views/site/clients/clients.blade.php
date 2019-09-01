@extends('site.layout.master')

@section('title')
    {{ __('site.clients') }}
@endsection
@section('content')


    <section class="s_2">
        <div class="container">
            <div class="header_divs">
                <h2>{{ __('site.clients') }}</h2>
                <p>{{ __('site.clientsMsg') }}</p>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="search_head2">
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
                        <li>
                            <button type="button" onclick="filterClients()">{{ __('site.search') }}</button>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="data">
                <div class="item_s2">
                    <ul>

                        @if($companies)
                            @foreach($companies as $company)
                                <li id="company_card" onclick="window.location = '{{ url('client/' . $company->id ) }}'">
                                    <div>
                                        <div class="imgsq">
                                            <img src="{{ asset($company->logo) }}">
                                        </div>
                                        @if(app()->isLocale('ar'))
                                            <p>{{ $company->name_ar }}</p>
                                        @else
                                            <p>{{ $company->name_en }}</p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
                <div class="pagi">
                    <nav aria-label="Page navigation example">

                        <ul class="pagination">
                            {{ $companies->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>


@endsection


@section('js')
    <script type="text/javascript">

        function filterClients(e) {
            let city_id = $('select#city').val();
            let catagory_id = $('select#catagory').val();
            let link = "{{ url('clients/' ) }}/" + city_id + "/"+catagory_id;
            $.ajax({
                url: link,
                method: "GET",

                success: function (res) {
                    if (res.status) {
                        window.location = link;
                        $('.data').html(res.data);
                    }
                }
            })
        }

    </script>
@endsection