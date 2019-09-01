<!doctype html>
<html lang="{{ app()->getLocale() }}" class="no-js">

<head>

    @include('site.layout.head')
</head>
<body>
@include('site.layout.header')

@yield('content')


@include('site.layout.mailingList')

@include('site.layout.footer')


@include('site.layout.scripts')
</body>
</html>