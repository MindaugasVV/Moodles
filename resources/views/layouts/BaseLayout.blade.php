<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height:100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/tinyMCE.js') }}"></script>


</head>
<body style="position: relative;min-height: 100%">
@include('headers/BaseHeader')

<div id="wrapper" @if(Auth::check()){{'class=toggled'}}@endif>
    @if(Auth::check())@include('Sidebars/BaseSidebar')@endif

    <div id="page-content-wrapper">
        <div class="container-fluid" style="padding-bottom: 20px;">
            @yield('container')
        </div>
    </div>
</div>

@include('footers/BaseFooter')
<script src="{{ asset('js/app.js') }}"></script>

@yield('footer_js')



</body>
</html>
