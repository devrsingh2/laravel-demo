<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset("assets/css/dashboard/main.css") }}" rel="stylesheet"></head>
@yield('header')
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('web.includes.dash-header')
    <div class="app-main">
        @include('web.includes.left-bar')
        <div class="app-main__outer">
            @yield('content')
            {{--            @include('web.includes.dash-footer')--}}
        </div>
        {{--        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="{{ asset("assets/js/dashboard/main.js") }}"></script>
@yield('footer')
</body>
</html>
