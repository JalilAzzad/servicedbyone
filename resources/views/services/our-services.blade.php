@php
    $seo_title =  "Our services | Serviced By ONE";
@endphp

@extends('layouts.app')

@section('content')
    <header class="bg-primary">
        <div class="container text-left" >
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 header-line">
                    <h1 class="header-title-1 tp-margin-bottom--quad">Our Services</h1>
                </div><!-- .col-8 -->
            </div><!-- .row -->
            <div class="row ">
                <div class="col-12">
                    <div class="row sticky-parent">
                        <div class="col-md-4 sticky-menu">
                            @foreach($category as $service)
                                <div class="servicepage-category-name">
                                    <a class="js-scroll-trigger" href="{{url('/our-services')}}#{{$service->name}}">{{$service->name}}</a>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-8">
                            <div class="is-mobile">
                                <div class="mobile-nav">
                                    @foreach($category as $service)
                                        <a class="js-scroll-trigger mobile-service-category" href="{{url('/our-services')}}#{{$service->name}}" >
                                            <span class="mobile-nav-text" >{{$service->name}}</span>
                                        </a>                 
                                    @endforeach
                                </div>
                            </div>               
                             @for($i = 0 ; $i < sizeof($services); $i++)
                                <div id="{{$category[$i]->name}}" class="service-list">
                                    <span class="service-category-name" >{{$category[$i]->name}}
                                    </span>
                                    <div class="mt-5 row">
                                        <?php $count = 0 ?>
                                        @foreach($services[$i]->services as $service)
                                            @if(isset($location))
                                                @php($url = $location->state_code.'/'.$location->slug.'/'.$service->slug)
                                            @else
                                                @php($url = 'services/'.$service->slug)
                                            @endif
                                            <div class="col-lg-4 col-sm-6 services-item mb-4">
                                                <div class="card h-100">
                                                        <a href="{{url($url)}}">
                                                            
                                                            @if($count++ < 4)
                                                            <img class="card-img-top" src="{{ asset(str_replace('public','storage', $service->resized_featured_image)) }}" alt="">
                                                            @endif
                                                        </a>
                                                        <div class="card-body">
                                                        <h4 class="card-title">
                                                        <a href="{{url($url)}}">{{$service->name}}</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr class="bb-line">
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix mt-5"></div>
            <a href="{{url()->previous() == url()->current() ? '/' :url()->previous()}}" class="btn btn-primary">Go Back</a>
        </div>
    </header>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.input-service-name').text('Our Services');
    </script>
@endsection