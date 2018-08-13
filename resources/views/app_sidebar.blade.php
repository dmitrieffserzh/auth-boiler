<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--@foreach($title as $item)--}}
        {{--{{ $item }}--}}
         {{--@if(next($title))--}}
                {{--/--}}
        {{--@endif--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--{{ $description }}--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_tags')
    <link href='{{ route('service.rss') }}' rel='alternate' title='RSS' type='application/rss+xml'/>
    <link href='{{ route('service.sitemap') }}' rel='alternate' title='Sitemap' type='application/rss+xml'/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('add_styles')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('add_scripts')
</head>
<body>
{{-- HEADER --}}
@include('app_header')

<div class="container">
    <div id="content" class="row no-gutters">
        <main class="main col-md-9">
            @yield('content')
        </main>
        <aside class="aside col-md-3">
            @yield('aside')
        </aside>
    </div>
</div>

{{-- FOOTER --}}
@include('app_footer')

{{-- MODAL --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"></div>
</div>
@yield('scripts')
</body>
</html>