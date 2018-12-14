<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
    <link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="{{url('/favicon.png')}}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(request()->route()->getName() == 'home')  
        @if( empty($seo) )
            <title>Serviced By ONE</title>
        @else
            <title>{{ $seo->slug }}</title>
            <meta name="description" content="{{ $seo->meta_desc }}">
            <meta name="keywords" content="{{ $seo->keywords }}">    
        @endif
    @elseif(isset($seo_title)) 
        @if( empty($seo) )
            <title>{{ $seo_title }}</title>
        @else
            <title>{{ $seo->slug }}</title>
            <meta name="description" content="{{ $seo->meta_desc }}">
            <meta name="keywords" content="{{ $seo->keywords }}">    
        @endif
    @elseif(isset($service->name))
        
        @if( empty($seo) )
            <title>{{ $service->name }} | Serviced By ONE</title>
        @else
            <title>{{ $seo->slug }}</title>
            <meta name="description" content="{{ $seo->meta_desc }}">
            <meta name="keywords" content="{{ $seo->keywords }}">    
        @endif

    @else   
        @if( empty($seo) )
            <title>Serviced By ONE</title>
        @else
            <title>{{ $seo->slug }}</title>
            <meta name="description" content="{{ $seo->meta_desc }}">
            <meta name="keywords" content="{{ $seo->keywords }}">    
        @endif
    @endif



    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/user/app.css') }}" rel="stylesheet">
    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/user/app.js') }}"></script>
</head>
<body id="page-top">
    @include('layouts.header')

    <div id="app">
        @unless(isset($is_homepage) && $is_homepage)
            {{--<div class="clearfix pt-5"></div>--}}
        @endif
        <div class="clearfix pt-5"></div>
        <main class="">
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')
    @yield('scripts')

    <!--search box-->
    <script type="text/javascript">
        $(document).ready(function() {
          $('.ui.searchdropdown')
            .dropdown({
              on: 'click'
            })
          ;
        });
 
        $('.input-search').on('click',function(){
            $('#dropdown-list').attr('class',$('#dropdown-list').attr('class').replace('visi-hide',''));
            $('#dropdown-list').focus();
        });

        $('#dropdown-list').on('focusout',function(){
            $('#dropdown-list').addClass('visi-hide');
        });

        function goOtherPage(path)
        {
            newClass = $('.span-search-box span').attr('class').replace('visi-hide','');
            $('.span-search-box span').attr('class',newClass);
            $('.span-search-box svg').attr('class','visi-hide');
            window.location = path;
            
        }

       
    </script>
    <!--search box-->
</body>
</html>
