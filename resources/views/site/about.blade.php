@extends('site.layout.master')

@section('title')
    {{ __('site.whoWeAre') }}
@endsection
@section('content')

    <section class="s_2">
        <div class="container">
            @if(app()->isLocale('ar'))
                {!! html_entity_decode($about->about_ar) !!}
            @else
                {!! $about->about_en !!}
            @endif
        </div>
    </section>


@endsection


