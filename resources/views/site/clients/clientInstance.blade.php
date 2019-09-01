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

